<?php
// CyberSafe - Profile Photo Upload for Certified ID Card
include "includes/db.php";
check_login();

$user_id = (int) $_SESSION['user_id'];
$msg = "";
$err = "";

// Upload directory path (normalized absolute directory)
$upload_dir = __DIR__ . '/uploads/';
if (!file_exists($upload_dir)) {
    @mkdir($upload_dir, 0777, true);
}
@chmod($upload_dir, 0777);

$is_dir_writable = is_writable($upload_dir);
if (!$is_dir_writable) {
    // Try chmod once more
    @chmod($upload_dir, 0777);
    clearstatcache(true, $upload_dir);
    $is_dir_writable = is_writable($upload_dir);
}

// 1. Fetch current photo
$stmt = mysqli_prepare($conn, "SELECT photo FROM users WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$userData = mysqli_fetch_assoc($res);
$currentPhoto = $userData['photo'] ?? "";

// 2. Handle Remove Photo
if (isset($_POST['remove_btn'])) {
    if (!empty($currentPhoto) && strpos($currentPhoto, 'uploads/') === 0) {
        $oldFile = __DIR__ . '/' . $currentPhoto;
        if (file_exists($oldFile) && is_file($oldFile) && basename($oldFile) !== '.gitkeep') {
            @unlink($oldFile);
        }
    }
    $updateStmt = mysqli_prepare($conn, "UPDATE users SET photo = NULL WHERE user_id = ?");
    mysqli_stmt_bind_param($updateStmt, "i", $user_id);
    if (mysqli_stmt_execute($updateStmt)) {
        $msg = "Profile photo removed.";
        $currentPhoto = "";
    } else {
        $err = "Database error while removing photo.";
    }
}

// 3. Handle Photo Upload
if (isset($_POST['upload_btn'])) {
    if (!isset($_FILES['photo']) || $_FILES['photo']['error'] == UPLOAD_ERR_NO_FILE) {
        $err = "Please select a photo to upload.";
    } elseif ($_FILES['photo']['error'] == UPLOAD_ERR_INI_SIZE || $_FILES['photo']['error'] == UPLOAD_ERR_FORM_SIZE) {
        $err = "File size exceeds server limit (" . ini_get('upload_max_filesize') . "). Photo was compressed, please try again.";
    } elseif ($_FILES['photo']['error'] != UPLOAD_ERR_OK) {
        $err = "Upload encountered an error (Code " . $_FILES['photo']['error'] . ").";
    } else {
        $filename = $_FILES['photo']['name'];
        $filesize = $_FILES['photo']['size'];
        $tmpname  = $_FILES['photo']['tmp_name'];

        // Extension check (handles JPG, JPEG, PNG, WEBP with any casing)
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowed = ["jpg", "jpeg", "png", "webp"];

        if (!in_array($ext, $allowed)) {
            $err = "Only JPG, PNG, or WebP image formats are allowed.";
        } elseif ($filesize > 5242880) { // 5MB limit
            $err = "File size is too big. Maximum allowed size is 5MB.";
        } else {
            // Verify image contents
            $imgInfo = @getimagesize($tmpname);
            if (!$imgInfo) {
                $err = "The uploaded file is not a valid image.";
            } else {
                if (!$is_dir_writable) {
                    $err = "Upload directory is not writable. On macOS, run in Terminal: <code>chmod -R 777 uploads</code>";
                } else {
                    $cleanExt = ($ext === 'jpeg') ? 'jpg' : $ext;
                    $new_filename = "photo_" . $user_id . "_" . time() . "." . $cleanExt;
                    $target_file = $upload_dir . $new_filename;
                    $db_path = "uploads/" . $new_filename;

                    if (move_uploaded_file($tmpname, $target_file)) {
                        // Ensure newly created file is readable by web server
                        @chmod($target_file, 0644);

                        // Delete previous user photo to keep uploads tidy
                        if (!empty($currentPhoto) && strpos($currentPhoto, 'uploads/') === 0) {
                            $oldFile = __DIR__ . '/' . $currentPhoto;
                            if (file_exists($oldFile) && is_file($oldFile) && basename($oldFile) !== '.gitkeep') {
                                @unlink($oldFile);
                            }
                        }

                        // Update database
                        $updateStmt = mysqli_prepare($conn, "UPDATE users SET photo = ? WHERE user_id = ?");
                        mysqli_stmt_bind_param($updateStmt, "si", $db_path, $user_id);

                        if (mysqli_stmt_execute($updateStmt)) {
                            $msg = "Profile photo uploaded successfully!";
                            $currentPhoto = $db_path;
                        } else {
                            $err = "Database update error: " . mysqli_error($conn);
                        }
                    } else {
                        $err = "Failed to save photo to disk. On macOS XAMPP, run in Terminal: <code>chmod -R 777 uploads</code>";
                    }
                }
            }
        }
    }
}

$photoExists = !empty($currentPhoto) && (file_exists($currentPhoto) || file_exists(__DIR__ . '/' . $currentPhoto));

$title = "Upload Photo";
include "includes/header.php";
?>

<div class="max-w-md mx-auto my-8">
  <div class="cyber-box rounded-2xl p-6 sm:p-7 border border-[#323743]">
    
    <div class="text-center mb-6">
      <div class="w-14 h-14 mx-auto mb-3 rounded-2xl bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E] shadow-lg shadow-[#B6FF2E]/10">
        <i data-lucide="camera" class="w-7 h-7"></i>
      </div>
      <h2 class="text-xl font-bold text-white">Upload <span class="text-[#B6FF2E]">ID Card Photo</span></h2>
      <p class="text-xs text-[#94A3B8] mt-1">Select your profile photo for your CyberSafe Certified ID Card</p>
    </div>

    <!-- macOS XAMPP Permission Helper (shown only if folder is not writable) -->
    <?php if (!$is_dir_writable) { ?>
      <div class="mb-4 p-3.5 bg-amber-950/40 border border-amber-500/40 rounded-xl text-amber-200 text-xs">
        <div class="font-bold flex items-center gap-1.5 mb-1 text-amber-300">
          <i class="fa-brands fa-apple"></i> macOS XAMPP Permission Required
        </div>
        <p class="text-[11px] text-amber-200/80 mb-2 leading-relaxed">
          On macOS, Apache runs as user <code>daemon</code>. Please grant write access to the uploads folder by running this in your terminal:
        </p>
        <div class="flex items-center gap-2">
          <code id="cmdCode" class="flex-1 bg-amber-950/60 text-amber-300 px-2.5 py-1 rounded font-mono text-[11px] select-all border border-amber-500/40">chmod -R 777 uploads</code>
          <button type="button" onclick="copyMacCmd()" class="px-2.5 py-1 bg-[#B6FF2E] text-[#23262F] hover:bg-[#9FE61B] rounded font-semibold text-[11px] transition-colors shrink-0 flex items-center gap-1">
            <i data-lucide="copy" class="w-3.5 h-3.5"></i><span id="copyBtnText">Copy</span>
          </button>
        </div>
      </div>
    <?php } ?>

    <!-- Feedback alerts -->
    <?php if ($msg != "") { ?>
      <div class="p-3 bg-[#B6FF2E]/15 border border-[#B6FF2E]/40 text-[#B6FF2E] rounded-lg text-xs mb-4 flex justify-between items-center">
        <span><?php echo $msg; ?></span>
        <a href="id_card.php" class="underline font-bold text-[#B6FF2E]">View ID Card &rarr;</a>
      </div>
    <?php } ?>

    <?php if ($err != "") { ?>
      <div class="p-3 bg-rose-950/40 border border-rose-500/40 text-rose-300 rounded-lg text-xs mb-4">
        <?php echo $err; ?>
      </div>
    <?php } ?>

    <!-- Photo Preview -->
    <div class="text-center mb-5">
      <div class="w-28 h-28 rounded-full border-2 border-[#B6FF2E] overflow-hidden mx-auto bg-[#181A20] flex items-center justify-center shadow-lg shadow-[#B6FF2E]/10">
        <?php if ($photoExists) { ?>
          <img id="preview" src="<?php echo htmlspecialchars($currentPhoto); ?>" class="w-full h-full object-cover">
          <span id="no-photo" class="text-[#94A3B8] text-xs hidden">No Photo Yet</span>
        <?php } else { ?>
          <img id="preview" src="" class="w-full h-full object-cover hidden">
          <span id="no-photo" class="text-[#94A3B8] text-xs">No Photo Yet</span>
        <?php } ?>
      </div>
      <div id="sizeBadge" class="hidden text-[10px] font-semibold text-[#B6FF2E] bg-[#B6FF2E]/15 inline-block px-2.5 py-0.5 rounded-full mt-2 border border-[#B6FF2E]/30"></div>
      <p class="text-[11px] text-[#94A3B8] mt-1.5">Supports JPG, PNG, WebP &bull; Auto-optimized for Mac & Retina</p>
    </div>

    <!-- Upload Form -->
    <form method="POST" enctype="multipart/form-data" id="photoForm" class="space-y-4">
      <div>
        <label class="block text-xs font-semibold text-[#E2E8F0] mb-1.5">Choose Image File:</label>
        <input 
          type="file" 
          name="photo" 
          id="photoInput" 
          accept="image/jpeg,image/png,image/webp,.jpg,.jpeg,.png,.webp" 
          required
          class="w-full text-xs text-[#94A3B8] file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#B6FF2E] file:text-[#23262F] hover:file:bg-[#9FE61B] cursor-pointer bg-[#181A20] p-2 rounded-xl border border-[#323743]"
        >
      </div>

      <button type="submit" name="upload_btn" id="uploadBtn" class="w-full btn-green py-2.5 rounded-xl text-xs font-bold flex items-center justify-center gap-2 shadow-lg">
        <i data-lucide="upload-cloud" class="w-4 h-4"></i>
        <span>Save &amp; Upload Photo</span>
      </button>

      <?php if ($photoExists) { ?>
        <button type="submit" name="remove_btn" onclick="return confirm('Remove your current photo?')" class="w-full py-2 rounded-xl text-xs font-semibold text-rose-400 bg-rose-950/30 hover:bg-rose-900/40 border border-rose-800/40 transition-colors flex items-center justify-center gap-1.5">
          <i data-lucide="trash-2" class="w-4 h-4"></i>
          <span>Remove Photo</span>
        </button>
      <?php } ?>

      <div class="flex items-center justify-between pt-2 text-xs">
        <a href="dashboard.php" class="text-[#94A3B8] hover:text-[#B6FF2E]">&larr; Back to Dashboard</a>
        <a href="id_card.php" class="text-[#B6FF2E] hover:underline font-semibold">Go to ID Card &rarr;</a>
      </div>
    </form>

  </div>
</div>

<script>
  // Live image preview & Smart Client-side Retina Auto-Resizer
  var photoInput = document.getElementById('photoInput');
  var preview = document.getElementById('preview');
  var noPhoto = document.getElementById('no-photo');
  var sizeBadge = document.getElementById('sizeBadge');
  var photoForm = document.getElementById('photoForm');

  if (photoInput) {
    photoInput.addEventListener('change', function() {
      var file = this.files[0];
      if (!file) return;

      var originalSizeKB = Math.round(file.size / 1024);

      var reader = new FileReader();
      reader.onload = function(e) {
        var img = new Image();
        img.onload = function() {
          preview.src = img.src;
          preview.classList.remove('hidden');
          if (noPhoto) noPhoto.classList.add('hidden');

          // Auto-resize high-resolution Retina screenshots/photos to ideal ID avatar size (max 800px)
          var maxDim = 800;
          var width = img.width;
          var height = img.height;

          if (width > maxDim || height > maxDim || file.size > 1500000) {
            if (width > height) {
              if (width > maxDim) {
                height = Math.round(height * (maxDim / width));
                width = maxDim;
              }
            } else {
              if (height > maxDim) {
                width = Math.round(width * (maxDim / height));
                height = maxDim;
              }
            }

            var canvas = document.createElement('canvas');
            canvas.width = width;
            canvas.height = height;
            var ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0, width, height);

            var outType = (file.type === 'image/png') ? 'image/png' : 'image/jpeg';
            canvas.toBlob(function(blob) {
              if (blob && blob.size < file.size) {
                var optimizedFile = new File([blob], file.name.replace(/\.[^/.]+$/, "") + (outType === 'image/png' ? '.png' : '.jpg'), {
                  type: outType,
                  lastModified: Date.now()
                });

                // Replace input files with optimized file if DataTransfer is supported
                try {
                  var dt = new DataTransfer();
                  dt.items.add(optimizedFile);
                  photoInput.files = dt.files;
                  var newSizeKB = Math.round(blob.size / 1024);
                  if (sizeBadge) {
                    sizeBadge.innerHTML = '<span class="inline-flex items-center gap-1"><i data-lucide="zap" class="w-3 h-3 inline"></i> Optimized: ' + originalSizeKB + ' KB &rarr; ' + newSizeKB + ' KB</span>';
                    sizeBadge.classList.remove('hidden');
                    if (typeof lucide !== 'undefined') lucide.createIcons();
                  }
                } catch(err) {
                  // Fallback to original file
                }
              }
            }, outType, 0.88);
          } else {
            if (sizeBadge) {
              sizeBadge.innerHTML = 'File Size: ' + originalSizeKB + ' KB';
              sizeBadge.classList.remove('hidden');
            }
          }
        };
        img.src = e.target.result;
      };
      reader.readAsDataURL(file);
    });
  }

  function copyMacCmd() {
    var cmd = document.getElementById('cmdCode');
    var btnText = document.getElementById('copyBtnText');
    if (cmd) {
      navigator.clipboard.writeText(cmd.innerText).then(function() {
        if (btnText) {
          btnText.innerText = 'Copied!';
          setTimeout(function() { btnText.innerText = 'Copy'; }, 2000);
        }
      });
    }
  }
</script>

<?php include "includes/footer.php"; ?>

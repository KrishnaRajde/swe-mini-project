<?php
// CyberSafe - Profile Photo Upload for ID Card
include "includes/db.php";
check_login();

$user_id = (int) $_SESSION['user_id'];
$msg = "";
$err = "";

// 1. Fetch current photo
$stmt = mysqli_prepare($conn, "SELECT photo FROM users WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$userData = mysqli_fetch_assoc($res);
$currentPhoto = $userData['photo'] ?? "";

// 2. Handle photo upload
if (isset($_POST['upload_btn'])) {
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $filename = $_FILES['photo']['name'];
        $filesize = $_FILES['photo']['size'];
        $tmpname  = $_FILES['photo']['tmp_name'];

        // Extension check
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowed = ["jpg", "jpeg", "png"];

        if (!in_array($ext, $allowed)) {
            $err = "Only JPG and PNG images are allowed.";
        } elseif ($filesize > 2097152) { // 2MB max
            $err = "File size is too big. Maximum allowed size is 2MB.";
        } else {
            // Upload directory
            $upload_folder = "uploads/";
            if (!file_exists($upload_folder)) {
                mkdir($upload_folder, 0777, true);
            }

            $new_filename = "photo_" . $user_id . "_" . time() . "." . $ext;
            $destination = $upload_folder . $new_filename;

            // On macOS XAMPP, Apache runs as "daemon" and cannot write to a folder owned by your user
            if (!is_writable($upload_folder)) {
                $err = "Upload folder is not writable. Run: chmod 777 uploads uploads/photos";
            } elseif (move_uploaded_file($tmpname, $destination)) {
                // Update photo column in users table
                $updateStmt = mysqli_prepare($conn, "UPDATE users SET photo = ? WHERE user_id = ?");
                mysqli_stmt_bind_param($updateStmt, "si", $destination, $user_id);

                if (mysqli_stmt_execute($updateStmt)) {
                    $msg = "Profile photo uploaded successfully!";
                    $currentPhoto = $destination;
                } else {
                    $err = "Database update error: " . mysqli_error($conn);
                }
            } else {
                $err = "Failed to save uploaded photo. Please try again.";
            }
        }
    } else {
        $err = "Please select a JPG or PNG photo to upload.";
    }
}

$title = "Upload Photo";
include "includes/header.php";
?>

<div class="max-w-md mx-auto my-8">
  <div class="cyber-box rounded-2xl p-6 sm:p-7 border border-[#D9BF8F]">
    
    <div class="text-center mb-6">
      <div class="text-3xl mb-1.5">📸</div>
      <h2 class="text-xl font-bold text-[#064E3B]">Upload ID Card Photo</h2>
      <p class="text-xs text-[#35604F] mt-1">Select your profile photo for your CyberSafe Certified ID Card</p>
    </div>

    <!-- Feedback alerts -->
    <?php if ($msg != "") { ?>
      <div class="p-3 bg-[#DDEBD9] border border-[#064E3B] text-[#064E3B] rounded-lg text-xs mb-4 flex justify-between items-center">
        <span><?php echo $msg; ?></span>
        <a href="id_card.php" class="underline font-bold text-[#064E3B]">View ID Card &rarr;</a>
      </div>
    <?php } ?>

    <?php if ($err != "") { ?>
      <div class="p-3 bg-rose-100 border border-rose-300 text-rose-700 rounded-lg text-xs mb-4">
        <?php echo $err; ?>
      </div>
    <?php } ?>

    <!-- Photo Preview -->
    <div class="text-center mb-6">
      <div class="w-28 h-28 rounded-full border-2 border-[#064E3B] overflow-hidden mx-auto bg-[#FDF8EF] flex items-center justify-center shadow-lg shadow-[#064E3B]/10">
        <?php if ($currentPhoto != "" && file_exists($currentPhoto)) { ?>
          <img id="preview" src="<?php echo htmlspecialchars($currentPhoto); ?>" class="w-full h-full object-cover">
        <?php } else { ?>
          <img id="preview" src="" class="w-full h-full object-cover hidden">
          <span id="no-photo" class="text-[#35604F] text-xs">No Photo Yet</span>
        <?php } ?>
      </div>
      <p class="text-[11px] text-[#35604F] mt-2">Max 2MB (JPG or PNG only)</p>
    </div>

    <!-- Upload Form -->
    <form method="POST" enctype="multipart/form-data" class="space-y-4">
      <div>
        <label class="block text-xs font-semibold text-[#064E3B] mb-1.5">Choose Image File:</label>
        <input 
          type="file" 
          name="photo" 
          id="photoInput" 
          accept=".jpg,.jpeg,.png" 
          required
          class="w-full text-xs text-[#35604F] file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#064E3B] file:text-[#F8E7C9] hover:file:bg-[#043B2D] cursor-pointer bg-[#FDF8EF] p-2 rounded-xl border border-[#D9BF8F]"
        >
      </div>

      <button type="submit" name="upload_btn" class="w-full btn-green py-2.5 rounded-xl text-xs font-bold flex items-center justify-center gap-2">
        <i class="fa-solid fa-cloud-arrow-up"></i>
        <span>Save & Upload Photo</span>
      </button>

      <div class="flex items-center justify-between pt-2 text-xs">
        <a href="dashboard.php" class="text-[#35604F] hover:text-[#043B2D]">&larr; Back to Dashboard</a>
        <a href="id_card.php" class="text-[#064E3B] hover:underline font-semibold">Go to ID Card &rarr;</a>
      </div>
    </form>

  </div>
</div>

<script>
  // Live image preview
  var photoInput = document.getElementById('photoInput');
  var preview = document.getElementById('preview');
  var noPhoto = document.getElementById('no-photo');

  if (photoInput) {
    photoInput.addEventListener('change', function() {
      var file = this.files[0];
      if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.classList.remove('hidden');
          if (noPhoto) noPhoto.classList.add('hidden');
        };
        reader.readAsDataURL(file);
      }
    });
  }
</script>

<?php include "includes/footer.php"; ?>

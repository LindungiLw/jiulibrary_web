<?php
session_start();
require_once 'config.php';
require_once 'koneksi.php';

if (!function_exists('str_starts_with')) {
    function str_starts_with($haystack, $needle) {
        return (string)$needle !== '' && strncmp($haystack, $needle, strlen($needle)) === 0;
    }
}

$koneksi = getKoneksi();
$query = $koneksi->query("SELECT * FROM organization_staff");
$staff_data = [];
if ($query) {
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $staff_data[$row['position_code']] = $row;
    }
}

function getStaff($code, $staff_data) {
    if (isset($staff_data[$code])) {
        $s = $staff_data[$code];
        
        $photo = htmlspecialchars($s['photo']);
        $name = htmlspecialchars($s['name']);
        
        // Fallback ke UI Avatars jika tidak ada foto
        if (empty($photo)) {
            $name_encoded = urlencode($name);
            // Gunakan inisial dari nama
            $photo = "https://ui-avatars.com/api/?name={$name_encoded}&background=94a3b8&color=fff&size=200";
        } elseif (!str_starts_with($photo, 'http')) {
            // Pastikan format path benar jika diakses dari root (menghapus ../ jika ada)
            if (str_starts_with($photo, '../')) {
                $photo = substr($photo, 3);
            }
        }
        
        return [
            'name' => $name,
            'role' => htmlspecialchars($s['position_name']),
            'email' => htmlspecialchars($s['email']),
            'photo' => $photo
        ];
    }
    return ['name' => 'N/A', 'role' => 'N/A', 'email' => '', 'photo' => ''];
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Organization - Dream Blue Library</title>
    
    <!-- Preload Critical Fonts -->
    <link rel="preload" href="assets/fonts/Poppins-Bold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/Poppins-Regular.woff2" as="font" type="font/woff2" crossorigin>

    <meta property="og:title" content="Organization - Dream Blue Library" />
    <meta property="og:description" content="Our Professional Management Team" />
    <meta property="og:image" content="assets/images/library-logo.webp" />
    <link rel="icon" type="image/webp" href="assets/images/library-logo.webp" />

    <link rel="stylesheet" href="assets/css/fonts.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/style/variable.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/base.css?v=1.2" />
    <link rel="stylesheet" href="assets/css/navbar.css?v=2.3" />
    <link rel="stylesheet" href="assets/css/style/modal.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/footer.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/responsive.css?v=3.1" />
    <link rel="stylesheet" href="assets/css/about.css?v=2.5" />
    
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
      /* PROFILE MODAL CSS - Inlined to bypass cache */
      .profile-modal-overlay {
        display: none;
        position: fixed;
        z-index: 10000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(5px);
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
      }
      .profile-modal-overlay.active { opacity: 1; }
      .profile-modal-content {
        background: #ffffff;
        padding: 0;
        border-radius: 20px;
        width: 90%;
        max-width: 400px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        position: relative;
        transform: translateY(20px) scale(0.95);
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        overflow: hidden;
      }
      .profile-modal-overlay.active .profile-modal-content {
        transform: translateY(0) scale(1);
      }
      .close-profile-modal {
        position: absolute;
        top: 15px;
        right: 20px;
        color: #94a3b8;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        z-index: 10;
        transition: color 0.2s;
      }
      .close-profile-modal:hover { color: #ef4444; }
      .profile-modal-body { display: flex; flex-direction: column; }
      .profile-modal-img-container {
        width: 100%;
        height: 120px;
        background: linear-gradient(135deg, var(--primary-blue), #3b82f6);
        position: relative;
        display: flex;
        justify-content: center;
      }
      #modalProfileImg {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        border: 4px solid white;
        object-fit: cover;
        position: absolute;
        bottom: -55px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        background: white;
      }
      .profile-modal-info {
        padding: 70px 30px 40px;
        text-align: center;
      }
      #modalProfileName {
        margin: 0 0 5px;
        color: #0f172a;
        font-size: 1.3rem;
        font-weight: 700;
      }
      .pm-role {
        color: #3b82f6;
        font-weight: 600;
        margin: 0;
        font-size: 0.95rem;
      }
      .pm-divider {
        height: 1px;
        background: #e2e8f0;
        margin: 15px auto;
        width: 50px;
      }
      .pm-contact {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #475569;
        font-size: 0.9rem;
        background: #f8fafc;
        padding: 10px 20px;
        border-radius: 50px;
        border: 1px solid #e2e8f0;
        word-break: break-all;
      }
      .pm-contact i { color: #94a3b8; }
    </style>
  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <header class="about-header">
      <div class="container">
        <h1 data-i18n="hdrOrgTitle">Library Organization</h1>
        <p data-i18n="hdrOrgDesc" style="margin-top: 10px; font-size: 1.1rem; opacity: 0.9">Our Professional Management Team</p>
      </div>
    </header>

    <section class="org-section">
      <div class="container" style="overflow-x: auto">
        <div class="custom-tree-layout">
          <div class="ct-row">
            <?php $s = getStaff('rector', $staff_data); ?>
            <div class="org-box box-rector" onclick="openProfileModal(this)"
                 data-name="<?php echo $s['name']; ?>" 
                 data-role="<?php echo $s['role']; ?>" 
                 data-email="<?php echo $s['email']; ?>" 
                 data-photo="<?php echo $s['photo']; ?>">
              <span class="role"><?php echo $s['role']; ?></span>
              <span class="name"><?php echo $s['name']; ?></span>
            </div>
          </div>

          <div class="ct-line-v"></div>

          <div class="ct-row ct-middle-row">
            <?php $s = getStaff('builder1', $staff_data); ?>
            <div class="org-box box-builder" onclick="openProfileModal(this)"
                 data-name="<?php echo $s['name']; ?>" 
                 data-role="<?php echo $s['role']; ?>" 
                 data-email="<?php echo $s['email']; ?>" 
                 data-photo="<?php echo $s['photo']; ?>">
              <span class="role"><?php echo $s['role']; ?></span>
              <span class="name"><?php echo $s['name']; ?></span>
            </div>

            <div class="ct-arrow-right"></div>

            <div class="ct-col">
              <?php $s = getStaff('head', $staff_data); ?>
              <div class="org-box box-head" onclick="openProfileModal(this)"
                   data-name="<?php echo $s['name']; ?>" 
                   data-role="<?php echo $s['role']; ?>" 
                   data-email="<?php echo $s['email']; ?>" 
                   data-photo="<?php echo $s['photo']; ?>">
                <span class="role"><?php echo $s['role']; ?></span>
                <span class="name"><?php echo $s['name']; ?></span>
              </div>
              <div class="ct-line-v"></div>
            </div>

            <div class="ct-arrow-left"></div>

            <?php $s = getStaff('builder2', $staff_data); ?>
            <div class="org-box box-builder" onclick="openProfileModal(this)"
                 data-name="<?php echo $s['name']; ?>" 
                 data-role="<?php echo $s['role']; ?>" 
                 data-email="<?php echo $s['email']; ?>" 
                 data-photo="<?php echo $s['photo']; ?>">
              <span class="role"><?php echo $s['role']; ?></span>
              <span class="name"><?php echo $s['name']; ?></span>
            </div>
          </div>

          <div class="ct-line-h" style="width: 282px"></div>
          <div class="ct-row" style="width: 282px; justify-content: space-between">
            <div class="ct-arrow-down"></div>
            <div class="ct-arrow-down"></div>
          </div>

          <div class="ct-row" style="gap: 40px">
            <?php $s = getStaff('librarian1', $staff_data); ?>
            <div class="org-box box-librarian" onclick="openProfileModal(this)"
                 data-name="<?php echo $s['name']; ?>" 
                 data-role="<?php echo $s['role']; ?>" 
                 data-email="<?php echo $s['email']; ?>" 
                 data-photo="<?php echo $s['photo']; ?>">
              <span class="role"><?php echo $s['role']; ?></span>
              <span class="name"><?php echo $s['name']; ?></span>
            </div>
            <?php $s = getStaff('librarian2', $staff_data); ?>
            <div class="org-box box-librarian" onclick="openProfileModal(this)"
                 data-name="<?php echo $s['name']; ?>" 
                 data-role="<?php echo $s['role']; ?>" 
                 data-email="<?php echo $s['email']; ?>" 
                 data-photo="<?php echo $s['photo']; ?>">
              <span class="role"><?php echo $s['role']; ?></span>
              <span class="name"><?php echo $s['name']; ?></span>
            </div>
          </div>

          <div class="ct-row" style="width: 282px; justify-content: space-between">
            <div class="ct-line-v"></div>
            <div class="ct-line-v"></div>
          </div>

          <div class="ct-line-h" style="width: 282px"></div>
          <div class="ct-line-v"></div>
          <div class="ct-line-h" style="width: 522px"></div>

          <div class="ct-row" style="width: 522px; justify-content: space-between">
            <div class="ct-arrow-down"></div>
            <div class="ct-arrow-down"></div>
            <div class="ct-arrow-down"></div>
          </div>

          <div class="ct-row" style="gap: 20px">
            <?php $s = getStaff('service1', $staff_data); ?>
            <div class="org-box box-service" onclick="openProfileModal(this)"
                 data-name="<?php echo $s['name']; ?>" 
                 data-role="<?php echo $s['role']; ?>" 
                 data-email="<?php echo $s['email']; ?>" 
                 data-photo="<?php echo $s['photo']; ?>">
              <span class="role" style="color: white; line-height: 1.4">
                <?php echo $s['name']; ?><br />
                <span style="font-size: 0.85em; font-weight: 400">(<?php echo str_replace('Student Service 1 ', '', $s['role']); ?>)</span>
              </span>
            </div>
            <?php $s = getStaff('service2', $staff_data); ?>
            <div class="org-box box-service" onclick="openProfileModal(this)"
                 data-name="<?php echo $s['name']; ?>" 
                 data-role="<?php echo $s['role']; ?>" 
                 data-email="<?php echo $s['email']; ?>" 
                 data-photo="<?php echo $s['photo']; ?>">
              <span class="role" style="color: white; line-height: 1.4">
                <?php echo $s['name']; ?><br />
                <span style="font-size: 0.85em; font-weight: 400">(<?php echo str_replace('Student Service 2 ', '', $s['role']); ?>)</span>
              </span>
            </div>
            <?php $s = getStaff('service3', $staff_data); ?>
            <div class="org-box box-service" onclick="openProfileModal(this)"
                 data-name="<?php echo $s['name']; ?>" 
                 data-role="<?php echo $s['role']; ?>" 
                 data-email="<?php echo $s['email']; ?>" 
                 data-photo="<?php echo $s['photo']; ?>">
              <span class="role" style="color: white; line-height: 1.4">
                <?php echo $s['name']; ?><br />
                <span style="font-size: 0.85em; font-weight: 400">(<?php echo str_replace('Student Service 3 ', '', $s['role']); ?>)</span>
              </span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Profile Modal Template -->
    <div id="orgProfileModal" class="modal profile-modal-overlay" style="display: none; position: fixed; z-index: 100000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(15, 23, 42, 0.7); backdrop-filter: blur(5px); justify-content: center; align-items: center; transition: opacity 0.3s ease;">
      <div class="modal-content profile-modal-content" style="background: #ffffff; padding: 0; border-radius: 20px; width: 90%; max-width: 400px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); position: relative; overflow: hidden; margin: auto;">
        <span class="close-profile-modal" onclick="closeProfileModal()" style="position: absolute; top: 15px; right: 20px; color: #94a3b8; font-size: 28px; font-weight: bold; cursor: pointer; z-index: 10;">&times;</span>
        <div class="profile-modal-body" style="display: flex; flex-direction: column;">
          <div class="profile-modal-img-container" style="width: 100%; height: 120px; background: linear-gradient(135deg, #1e3a8a, #3b82f6); position: relative; display: flex; justify-content: center;">
            <img id="modalProfileImg" src="" alt="Profile Image" style="width: 110px; height: 110px; border-radius: 50%; border: 4px solid white; object-fit: cover; position: absolute; bottom: -55px; box-shadow: 0 10px 20px rgba(0,0,0,0.1); background: white;" />
          </div>
          <div class="profile-modal-info" style="padding: 70px 30px 40px; text-align: center;">
            <h3 id="modalProfileName" style="margin: 0 0 5px; color: #0f172a; font-size: 1.3rem; font-weight: 700;">Name</h3>
            <p id="modalProfileRole" class="pm-role" style="color: #3b82f6; font-weight: 600; margin: 0; font-size: 0.95rem;">Role</p>
            <div class="pm-divider" style="height: 1px; background: #e2e8f0; margin: 15px auto; width: 50px;"></div>
            <div class="pm-contact" style="display: inline-flex; align-items: center; gap: 10px; color: #475569; font-size: 0.9rem; background: #f8fafc; padding: 10px 20px; border-radius: 50px; border: 1px solid #e2e8f0; word-break: break-all;">
              <i class="fa-solid fa-envelope" style="color: #94a3b8;"></i>
              <span id="modalProfileEmail">email@example.com</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include 'footer.php'; ?>
    
    <!-- BlueBot & A11y Widgets -->
    <?php include 'chatbot-widget.php'; ?>
    <?php include 'a11y-widget.php'; ?>

    <!-- Scripts -->
    <script>
      window.BASE_URL = "<?php echo defined('BASE_URL') ? BASE_URL : ''; ?>";
      
      // Profile Modal Logic
      function openProfileModal(element) {
        const name = element.getAttribute('data-name');
        const role = element.getAttribute('data-role');
        const email = element.getAttribute('data-email');
        const photo = element.getAttribute('data-photo');

        document.getElementById('modalProfileImg').src = photo;
        document.getElementById('modalProfileName').innerText = name;
        document.getElementById('modalProfileRole').innerText = role;
        document.getElementById('modalProfileEmail').innerText = email;

        const modal = document.getElementById('orgProfileModal');
        modal.style.display = 'flex';
        // Add a small delay to allow display:flex to apply before adding opacity class
        setTimeout(() => {
          modal.classList.add('active');
        }, 10);
      }

      function closeProfileModal() {
        const modal = document.getElementById('orgProfileModal');
        modal.classList.remove('active');
        // Wait for animation to finish before hiding
        setTimeout(() => {
          modal.style.display = 'none';
        }, 300);
      }

      // Close if clicked outside
      window.addEventListener('click', function(event) {
        const modal = document.getElementById('orgProfileModal');
        if (event.target === modal) {
          closeProfileModal();
        }
      });
    </script>
    <script defer src="assets/js/dictionary.js?v=1.3"></script>
    <script defer src="assets/js/main.js?v=2.2"></script>
    <script defer src="assets/js/chatbot.js?v=1.8"></script>
  </body>
</html>

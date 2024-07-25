<!-- User Profile Page Design ---------------------------------------------------------------->
<?php
//Modules
require 'includes/config.php';
require 'includes/user_data.php';
require 'partials/header.php';
?>

<div class="profile-container">
    <div class="cover-photo"
        style="background: url('<?php echo htmlspecialchars($cover_photo); ?>') no-repeat center center; background-size: cover;">
    </div>
    <a href="#" class="custom-link"><img src="<?php echo htmlspecialchars($user_photo); ?>" alt="Profile"
            class="profile-pic"></a>
</div>
<div class="user-details d-flex justify-content-between align-items-center">
    <div>
        <?php if (!empty($user['username'])): ?>
            <h2><?php echo htmlspecialchars($user['username']); ?></h2>
        <?php else: ?>
            <h2>Unknown User</h2>
        <?php endif; ?>

        <p><?php echo htmlspecialchars($user['bio'] ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'); ?>
        </p>

        <?php if (!empty($user['email'])): ?>
            <p><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($user['email']); ?></p>
        <?php endif; ?>

        <?php if (!empty($user['phone'])): ?>
            <p><i class="fas fa-phone"></i> <?php echo htmlspecialchars($user['phone']); ?></p>
        <?php endif; ?>

        <?php if (!empty($user['website'])): ?>
            <p><i class="fas fa-globe"></i> <a href="<?php echo htmlspecialchars($user['website']); ?>" target="_blank"
                    class="custom-link"><?php echo htmlspecialchars($user['website']); ?></a></p>
        <?php endif; ?>

        <?php if (!empty($user['company_name'])): ?>
            <p><i class="fas fa-building"></i> <?php echo htmlspecialchars($user['company_name']); ?></p>
        <?php endif; ?>
    </div>
    <div>
        <?php if ($user['id'] == $user_id): ?>
            <button class="btn btn-dark btn-new-post">New Post</button>
        <?php else: ?>
            <button class="btn btn-dark btn-follow">Follow</button>
        <?php endif; ?>
        <div class="dropdown d-inline-block ml-2">
            <button class="btn btn-link dropdown-toggle" type="button" id="profileDropdown" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v" style="color: #000;"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="edit_profile.php">Edit Profile</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 posts">
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <div class="post-header d-flex align-items-center">
                    <a href="user.php?userId=<?php echo $user['id']; ?>" class="custom-link">
                        <img src="<?php echo htmlspecialchars($user_photo); ?>" alt="Profile">
                    </a>
                    <a href="user.php?userId=<?php echo $user['id']; ?>" class="ml-2 custom-link">
                        <h5><?php echo htmlspecialchars($user['username']); ?></h5>
                    </a>
                    <button class="btn btn-link ml-auto"><i class="fas fa-ellipsis-v" style="color: #000;"></i></button>
                </div>
                <div class="post-body">
                    <h6><?php echo htmlspecialchars($post['title']); ?></h6>
                    <p><?php echo htmlspecialchars($post['body']); ?></p>
                </div>
                <div class="post-footer">
                    <button class="btn btn-light"><i class="far fa-thumbs-up"></i></button>
                    <button class="btn btn-light"><i class="far fa-comment"></i></button>
                    <button class="btn btn-light ml-auto"><i class="far fa-share-square"></i></button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="col-md-4">
        <?php include 'includes/recommended_users.php'; ?>
    </div>
</div>

<?php
require 'partials/footer.php';
?>
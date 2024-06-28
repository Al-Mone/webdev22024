<?php
require 'includes/config.php';
require 'includes/user_data.php';
require 'partials/header.php';
?>

<div class="profile-container">
    <div class="cover-photo"
        style="background: url('<?php echo htmlspecialchars($cover_photo); ?>') no-repeat center center; background-size: cover;">
    </div>
    <a href="#"><img src="<?php echo htmlspecialchars($user_photo); ?>" alt="Profile" class="profile-pic"></a>
</div>
<div class="user-details">
    <?php if (!empty($user['username'])): ?>
        <h2><?php echo htmlspecialchars($user['username']); ?></h2>
    <?php else: ?>
        <h2>Unknown User</h2>
    <?php endif; ?>

    <p><?php echo htmlspecialchars($user['bio'] ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'); ?></p>

    <?php if (!empty($user['email'])): ?>
        <p><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($user['email']); ?></p>
    <?php endif; ?>

    <?php if (!empty($user['phone'])): ?>
        <p><i class="fas fa-phone"></i> <?php echo htmlspecialchars($user['phone']); ?></p>
    <?php endif; ?>

    <?php if (!empty($user['website'])): ?>
        <p><i class="fas fa-globe"></i> <a href="<?php echo htmlspecialchars($user['website']); ?>"
                target="_blank"><?php echo htmlspecialchars($user['website']); ?></a></p>
    <?php endif; ?>

    <?php if (!empty($user['company_name'])): ?>
        <p><i class="fas fa-building"></i> <?php echo htmlspecialchars($user['company_name']); ?></p>
    <?php endif; ?>

    <?php if ($user['id'] == $user_id): ?>
        <button class="btn btn-dark btn-new-post">New Post</button>
    <?php else: ?>
        <button class="btn btn-dark btn-follow">Follow</button>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col-md-8 posts">
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <div class="post-header">
                    <img src="<?php echo htmlspecialchars($user_photo); ?>" alt="Profile">
                    <h5><?php echo htmlspecialchars($user['username']); ?></h5>
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
    <div class="col-md-4 recommended-users">
        <h5>Recommended Users</h5>
        <?php foreach ($recommended_users as $recommended_user): ?>
            <div class="recommended-user">
                <div class="recommended-user-header">
                    <img src="<?php echo htmlspecialchars(!empty($recommended_user['profile_photo']) ? $recommended_user['profile_photo'] : '../media/default-profile.jpg'); ?>"
                        alt="Profile">
                    <h6><?php echo htmlspecialchars($recommended_user['username']); ?></h6>
                </div>
                <div class="recommended-user-footer">
                    <button class="btn btn-light">Follow</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
require 'partials/footer.php';
?>
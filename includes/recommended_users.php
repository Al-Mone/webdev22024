<!-- Module for displaying recommended users -------------------------------->

<?php if (!empty($recommended_users)): ?>
    <div class="recommended-users">
        <h5>Recommended Users</h5>
        <?php foreach ($recommended_users as $recommended_user): ?>
            <div class="recommended-user mb-3">
                <div class="recommended-user-header d-flex align-items-center">
                    <a href="user.php?userId=<?php echo htmlspecialchars($recommended_user['id']); ?>">
                        <img src="<?php echo htmlspecialchars(!empty($recommended_user['profile_photo']) ? $recommended_user['profile_photo'] : '../media/default-profile.jpg'); ?>"
                            alt="Profile">
                    </a>
                    <a href="user.php?userId=<?php echo htmlspecialchars($recommended_user['id']); ?>"
                        class="ml-2 link-to-user">
                        <h6><?php echo htmlspecialchars($recommended_user['username']); ?></h6>
                    </a>
                </div>
                <div class="recommended-user-footer d-flex justify-content-between">
                    <button class="btn btn-light">Follow</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
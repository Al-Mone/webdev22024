<!-- Search Page Design ---------------------------------------------------------------->
<?php
// Modules
require 'includes/search_data.php';
require 'partials/header.php';
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="results-container mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>Search Results</h3>
                    <div>
                        <a href="?query=<?php echo htmlspecialchars($query); ?>&type=users"
                            class="btn btn-dark">Users</a>
                        <a href="?query=<?php echo htmlspecialchars($query); ?>&type=posts"
                            class="btn btn-dark">Posts</a>
                    </div>
                </div>
                <?php foreach ($results as $result): ?>
                    <div class="result-item mb-3">
                        <?php if ($type === 'users'): ?>
                            <div class="result-item-header d-flex align-items-center">
                                <a href="user.php?userId=<?php echo htmlspecialchars($result['id']); ?>">
                                    <img src="<?php echo htmlspecialchars(!empty($result['profile_photo']) ? $result['profile_photo'] : '../media/default-profile.jpg'); ?>"
                                        alt="Profile" class="profile-pic-iconified">
                                    <h5 class="ml-2"><?php echo htmlspecialchars($result['username']); ?></h5>
                                </a>
                            </div>
                            <div class="result-item-body">
                                <p><?php echo htmlspecialchars($result['name'] ?? ''); ?></p>
                            </div>
                        <?php else: ?>
                            <div class="result-item-header d-flex align-items-center">
                                <a href="user.php?userId=<?php echo htmlspecialchars($result['user_id']); ?>">
                                    <img src="<?php echo htmlspecialchars(!empty($result['profile_photo']) ? $result['profile_photo'] : '../media/default-profile.jpg'); ?>"
                                        alt="Profile" class="profile-pic-iconified">
                                    <h5 class="ml-2"><?php echo htmlspecialchars($result['title']); ?></h5>
                                </a>
                            </div>
                            <div class="result-item-body">
                                <p><?php echo htmlspecialchars($result['body']); ?></p>
                            </div>
                            <div class="result-item-footer d-flex align-items-center">
                                <small class="text-muted">Posted by <?php echo htmlspecialchars($result['username']); ?></small>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-4">
            <?php include 'includes/recommended_users.php'; ?>
        </div>
    </div>
</div>

<?php
require 'partials/footer.php';
?>
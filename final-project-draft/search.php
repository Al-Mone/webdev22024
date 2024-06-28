<?php
// Modules
require 'includes/search_data.php';
require 'partials/header.php';
?>

<div class="container mt-5">
    <div class="results-container mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Search Results</h3>
            <div>
                <a href="?query=<?php echo htmlspecialchars($query); ?>&type=users" class="btn btn-dark">Users</a>
                <a href="?query=<?php echo htmlspecialchars($query); ?>&type=posts" class="btn btn-dark">Posts</a>
            </div>
        </div>
        <?php foreach ($results as $result): ?>
            <div class="result-item mb-3">
                <div class="result-item-header d-flex align-items-center">
                    <img src="<?php echo htmlspecialchars(!empty($result['profile_photo']) ? $result['profile_photo'] : '../media/default-profile.jpg'); ?>"
                        alt="Profile">
                    <h5 class="ml-2"><?php echo htmlspecialchars($result['username'] ?? $result['title']); ?></h5>
                </div>
                <div class="result-item-body">
                    <p><?php echo htmlspecialchars($result['name'] ?? $result['body']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="recommended-users">
        <h5>Recommended Users</h5>
        <?php foreach ($recommended_users as $recommended_user): ?>
            <div class="recommended-user mb-3">
                <div class="recommended-user-header d-flex align-items-center">
                    <img src="<?php echo htmlspecialchars(!empty($recommended_user['profile_photo']) ? $recommended_user['profile_photo'] : '../media/default-profile.jpg'); ?>"
                        alt="Profile">
                    <h6 class="ml-2"><?php echo htmlspecialchars($recommended_user['username']); ?></h6>
                </div>
                <div class="recommended-user-footer d-flex justify-content-between">
                    <button class="btn btn-light">Follow</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
require 'partials/footer.php';
?>
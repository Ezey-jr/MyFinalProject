<?php

require_once "Controller/UserController.php";
require_once "Core/Session.php";
require_once "Core/Message.php";
require_once "Core/Helpers.php";
require_once "Core/Auth.php";
require_once "Controller/PostController.php";
// start session everytime
Session::start();
Auth::login_redirect();

$user_type = Auth::user()->user_type == 1 ? "Administrator" : "Moderator";

$total_posts = count(PostController::index()) ;

?>


<!-- dashboard.php -->
<?php
// ── DB connection will go here ──
// $conn = new mysqli("localhost", "user", "password", "blog_db");

// ── Sample data (replace with real DB queries) ──
// $total_posts      = 42;   // SELECT COUNT(*) FROM posts
$published_posts  = 35;   // SELECT COUNT(*) FROM posts WHERE status = 'published'
$draft_posts      = 7;    // SELECT COUNT(*) FROM posts WHERE status = 'draft'
$total_views      = 8410; // SELECT SUM(views) FROM posts

$recent_posts = PostController::latest(4);

$category_emojis = ["Tutorial"=>"📘","Frontend"=>"🎨","Backend"=>"⚙️","Database"=>"🗄️","General"=>"📝"];
?>


<?php $page_title = "view" ?>

<?php include_once "views/layouts/header.php" ?> 

  <!-- Page Content -->
  <main class="page-content">

    <!-- Stat Cards -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-icon orange">
          <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
            <polyline points="14 2 14 8 20 8"/>
          </svg>
        </div>
        <div class="stat-body">
          <div class="stat-value"><?php echo $total_posts; ?></div>
          <div class="stat-label">Total Posts</div>
          <div class="stat-change up">↑ 4 this month</div>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon green">
          <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
        </div>
        <div class="stat-body">
          <div class="stat-value"><?php echo $published_posts; ?></div>
          <div class="stat-label">Published</div>
          <div class="stat-change up">↑ 3 this month</div>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon yellow">
          <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" y1="8" x2="12" y2="12"/>
            <line x1="12" y1="16" x2="12.01" y2="16"/>
          </svg>
        </div>
        <div class="stat-body">
          <div class="stat-value"><?php echo $draft_posts; ?></div>
          <div class="stat-label">Drafts</div>
          <div class="stat-change down">↓ 1 from last month</div>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon red">
          <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
            <circle cx="12" cy="12" r="3"/>
          </svg>
        </div>
        <div class="stat-body">
          <div class="stat-value"><?php echo number_format($total_views); ?></div>
          <div class="stat-label">Total Views</div>
          <div class="stat-change up">↑ 12% this week</div>
        </div>
      </div>
    </div>

    <!-- Dashboard Grid -->
    <div class="dashboard-grid">

      <!-- Left col -->
      <div style="display:flex; flex-direction:column; gap:1rem;">

        <!-- Quick Actions -->
        <div class="card">
          <div class="card-header">
            <span class="card-title">Quick Actions</span>
          </div>
          <div class="card-body" style="padding-top:.75rem;">
            <div class="quick-actions">
              <a href="add-post.php" class="quick-action-btn">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <line x1="12" y1="5" x2="12" y2="19"/>
                  <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Write New Post
              </a>
              <a href="posts.php" class="quick-action-btn">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <line x1="8" y1="6" x2="21" y2="6"/>
                  <line x1="8" y1="12" x2="21" y2="12"/>
                  <line x1="8" y1="18" x2="21" y2="18"/>
                  <line x1="3" y1="6" x2="3.01" y2="6"/>
                  <line x1="3" y1="12" x2="3.01" y2="12"/>
                  <line x1="3" y1="18" x2="3.01" y2="18"/>
                </svg>
                Manage All Posts
              </a>
              <a href="#" class="quick-action-btn">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                  <polyline points="22,6 12,13 2,6"/>
                </svg>
                View Drafts
              </a>
            </div>
          </div>
        </div>

        <!-- Activity Feed -->
        <div class="card">
          <div class="card-header">
            <span class="card-title">Recent Activity</span>
          </div>
          <div class="card-body">
            <div class="activity-item">
              <div class="activity-dot green"></div>
              <div>
                <div class="activity-text">Post <strong>"Getting Started with PHP"</strong> was published</div>
                <div class="activity-time">2 hours ago</div>
              </div>
            </div>
            <div class="activity-item">
              <div class="activity-dot orange"></div>
              <div>
                <div class="activity-text">Draft <strong>"JavaScript Promises"</strong> updated</div>
                <div class="activity-time">5 hours ago</div>
              </div>
            </div>
            <div class="activity-item">
              <div class="activity-dot green"></div>
              <div>
                <div class="activity-text">Post <strong>"10 CSS Tips"</strong> reached 500 views</div>
                <div class="activity-time">Yesterday</div>
              </div>
            </div>
            <div class="activity-item">
              <div class="activity-dot red"></div>
              <div>
                <div class="activity-text">Post <strong>"Old Tutorial v1"</strong> was archived</div>
                <div class="activity-time">2 days ago</div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Right col: Recent Posts -->
      <div class="card">
        <div class="card-header">
          <span class="card-title">Recent Posts</span>
          <a href="posts.php" class="btn btn-secondary" style="font-size:.78rem; padding:.35rem .75rem;">View All</a>
        </div>
        <div class="card-body">
          <?php foreach ($recent_posts as $post): ?>
          <div class="recent-post-item">
            <div class="recent-post-thumb">
              <?php echo $category_emojis[$post->category] ?? '📝'; ?>
            </div>
            <div class="recent-post-info">
              <div class="recent-post-title"><?php echo htmlspecialchars($post->title); ?></div>
              <div class="recent-post-meta">
                <span class="category-pill"><?php echo htmlspecialchars($post->category); ?></span>
                &nbsp;·&nbsp;<?php echo $post->created_at; ?>
                &nbsp;·&nbsp;
                <span class="badge <?php echo $post->status === 'published' ? 'badge-published' : 'badge-draft'; ?>">
                  <?php echo ucfirst($post->status); ?>
                </span>
              </div>
            </div>
            <div style="display:flex; gap:.3rem; flex-shrink:0;">
              <a href="edit_post.php?id=<?php echo $post->id; ?>" class="action-btn" title="Edit">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
              </a>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </main>


<?php include_once "views/layouts/footer.php" ?>
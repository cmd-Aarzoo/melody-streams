<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: Login/index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Music Discovery</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>

    <!-- Tailwind Inline Config -->
    <script>
      tailwind.config = {
        darkMode: 'class',
        theme: {
          extend: {
            colors: {
              'background-light': '#ffffff',
              'background-dark': '#111418',
              'primary': '#6366f1'
            }
          }
        }
      }
    </script>

    <link rel="stylesheet" href="styles.css">
</head>

<body class="bg-background-light dark:bg-background-dark text-[#111418] dark:text-white font-display min-h-screen flex flex-col antialiased selection:bg-primary/30">

<div id="cursor-blob"></div>

<!-- ========== HEADER ========== -->
<header id="mainHeader"
class="header-animate sticky top-0 z-50 w-full bg-white/80 dark:bg-[#111418]/80 backdrop-blur-md border-b border-[#f0f2f4] dark:border-gray-800 transition-all duration-300">

<div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8">

<!-- ===== TOP ROW ===== -->
<div class="flex items-center justify-between h-16 gap-4 sm:gap-8">

<!-- Logo -->
<div class="logo-hover flex items-center gap-3 shrink-0 cursor-pointer">
    <div class="size-8 text-primary">
        <span class="material-symbols-outlined text-3xl">music_note</span>
    </div>
    <h2 class="text-[#111418] dark:text-white text-xl font-bold tracking-tight">
        MelodyStream
    </h2>
</div>

<!-- Search -->
<div class="hidden sm:flex max-w-[560px] w-full items-center">
    <div class="relative flex w-full items-stretch rounded-full h-10 bg-[#f0f2f4] dark:bg-gray-800">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-[#617589] text-[20px]">
            search
        </span>
        <!-- search button work kre toh yaha changes kiye hai  -->
        <input
            id="searchInput"
            class="form-input w-full rounded-full bg-transparent px-4 pl-10 text-sm"
            placeholder="Search albums, artists...">

    </div>
</div>

<!-- Right Buttons -->
<div class="flex items-center gap-2">

    <button class="yt-btn" title="Home">
        <span class="material-symbols-outlined">home</span>
    </button>

    <button class="yt-btn" title="Explore">
        <span class="material-symbols-outlined">explore</span>
    </button>

    <button class="yt-btn" title="Create">
        <span class="material-symbols-outlined">add_circle</span>
    </button>

    <button class="yt-btn relative" title="Notifications">
        <span class="material-symbols-outlined">notifications</span>
        <span class="absolute top-1 right-1 h-2 w-2 bg-red-500 rounded-full"></span>
    </button>

    <button onclick="toggleDarkMode()" class="yt-btn" title="Theme">
        <span class="material-symbols-outlined dark:hidden">dark_mode</span>
        <span class="material-symbols-outlined hidden dark:block">light_mode</span>
    </button>

    <div class="profile-wrapper">
        <button id="profileToggle" class="yt-btn" type="button">
            <span class="material-symbols-outlined">account_circle</span>
        </button>

        <div id="profileCard" class="profile-card">
            <span class="profile-name">
                <?= htmlspecialchars($_SESSION['name'] ?? 'User') ?>
            </span>
            <span class="profile-email">
                <?= htmlspecialchars($_SESSION['email'] ?? '') ?>
            </span>
            <hr>
            <a href="Login/logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

</div>
</div>

<!-- ===== CATEGORY BUTTONS ===== -->
<div id="tabBar"
     class="no-scrollbar flex items-center gap-3 pb-3 overflow-x-auto">

    <button class="tab-btn active-tab h-9 px-5 rounded-full whitespace-nowrap">All</button>
    <button class="tab-btn h-9 px-5 rounded-full whitespace-nowrap">Gaming</button>
    <button class="tab-btn h-9 px-5 rounded-full whitespace-nowrap">Music</button>
    <button class="tab-btn h-9 px-5 rounded-full whitespace-nowrap">Movies</button>
    <button class="tab-btn h-9 px-5 rounded-full whitespace-nowrap">Recommended</button>

</div>

</div>
</header>

<!-- ========== MAIN ========== -->
<main class="flex-grow max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- Player View -->
<!-- ===== PLAYER VIEW ===== -->
 <!-- yaha abhi change kiya hai -->
<div id="playerView" class="hidden fixed inset-0 bg-white z-50 overflow-y-auto">

    <div class="max-w-[1200px] mx-auto px-4 py-4">

        <!-- Video Wrapper -->
        <div class="w-full aspect-video rounded-xl overflow-hidden bg-black">
            <iframe
                id="ytPlayer"
                class="w-full h-full"
                frameborder="0"
                allow="autoplay; encrypted-media"
                allowfullscreen>
            </iframe>
        </div>

        <!-- Back Button (moved to bottom) -->
        <button onclick="closePlayer()"
            class="mt-6 inline-flex items-center gap-2 text-blue-500 font-medium">
            ← Back
        </button>

    </div>
</div>



    <div class="masonry-grid"></div>

</main>


<footer class="w-full border-t border-gray-200 dark:border-gray-800 py-4">
    <p class="text-center text-sm text-[#617589] dark:text-gray-400">
        © <span id="year"></span> MelodyStream. All rights reserved.
    </p>
</footer>


<script src="script.js"></script>



</body>
</html>




// Check for saved dark mode preference
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
    console.log('Dark mode enabled on page load');
} else {
    document.documentElement.classList.remove('dark');
    console.log('Light mode enabled on page load');
}

// Dark mode toggle functionality
document.getElementById('darkModeToggle').addEventListener('click', function() {
    if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        localStorage.theme = 'light';
        console.log('Switched to light mode');
    } else {
        document.documentElement.classList.add('dark');
        localStorage.theme = 'dark';
        console.log('Switched to dark mode');
    }
});
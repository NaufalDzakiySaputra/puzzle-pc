// Dark mode toggle
const themeToggle = document.getElementById('theme-toggle');

if (themeToggle) {
    // Cek preference yang tersimpan
    const currentTheme = localStorage.getItem('theme');
    if (currentTheme === 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
        if (themeToggle.checked !== undefined) themeToggle.checked = true;
    }

    // Handle toggle click
    themeToggle.addEventListener('change', function() {
        if (this.checked) {
            document.documentElement.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.removeAttribute('data-theme');
            localStorage.setItem('theme', 'light');
        }
    });
}
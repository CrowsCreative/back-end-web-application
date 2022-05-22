const sidebarCollapse = document.querySelector('#sidebarCollapse');

sidebarCollapse.addEventListener('click', () => {
    document.querySelector('#sidebar').classList.toggle('active');
});
document.addEventListener("DOMContentLoaded", () => {
    const userRole = "<?php echo isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) : ''; ?>";
    const adminLinks = document.querySelectorAll(".admin-link");
    const comptableLinks = document.querySelectorAll(".comptable-link");
    const gestionnaireLinks = document.querySelectorAll(".gestionnaire-link");

    if (userRole === "admin") {
        adminLinks.forEach(link => link.style.display = "block");
    } else if (userRole === "comptable") {
        comptableLinks.forEach(link => link.style.display = "block");
    } else if (userRole === "gestionnaire") {
        gestionnaireLinks.forEach(link => link.style.display = "block");
    }
});
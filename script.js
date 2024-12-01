// Toggle Mobile Navigation
document.querySelector('.nav-toggle').addEventListener('click', () => {
    document.querySelector('.nav-links').classList.toggle('active');
});

// Redirect to login page
function redirectToLogin() {
    window.location.href = "login.php";
}

    // Smooth scrolling when clicking navbar links
    const links = document.querySelectorAll(".nav-links a");
    links.forEach(link => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const targetId = link.getAttribute("href").substring(1);
            const targetSection = document.getElementById(targetId);
            targetSection.scrollIntoView({
                behavior: "smooth"
            });
        });
    });

    // Scroll-triggered animations for sections
    const sections = document.querySelectorAll('section');
    const options = {
        threshold: 0.5, // Trigger when 50% of the section is visible
        rootMargin: "0px 0px -100px 0px"
    };

    const sectionObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-visible');
                observer.unobserve(entry.target); // Unobserve after animation triggers once
            }
        });
    }, options);

    sections.forEach(section => {
        sectionObserver.observe(section);
    });

    // Responsive navbar toggle for mobile view
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');

    navToggle.addEventListener('click', () => {
        navLinks.classList.toggle('nav-links-visible');
    });
    

    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("registration-form");
    
        form.addEventListener("submit", function(event) {
            let valid = true;
    
            const surname = document.getElementsByName("surname")[0].value;
            if (surname.length < 2) {
                alert("Surname must be at least 2 characters.");
                valid = false;
            }
    
            const firstName = document.getElementsByName("first_name")[0].value;
            if (firstName.length < 2) {
                alert("First name must be at least 2 characters.");
                valid = false;
            }
    
            if (!valid) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
            // Validate phone number (simple check for numeric)
            const phoneNumber = document.getElementById("phone_number").value;
            if (!/^\d+$/.test(phoneNumber)) {
                alert("Phone number must contain only digits.");
                valid = false;
            }
    
            // Prevent form submission if validation fails
            if (!valid) {
                event.preventDefault();
            }
        });
    });
    
 // dashboard.js
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.sidebar ul li a');
    
    links.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const target = document.querySelector(link.getAttribute('href'));
            document.querySelectorAll('.content > div').forEach(div => {
                div.style.display = 'none'; // Hide all sections
            });
            target.style.display = 'block'; // Show the selected section
        });
    });

    // Show the first section by default
    document.querySelector('.content > div').style.display = 'block';

    // Fetch the admin report data
    if (document.querySelector('#reports')) {
        fetchAdminData();
    }
});

// Function to approve a user
function approveUser(userId) {
    fetch(`approve_user.php?id=${userId}`, { method: 'GET' })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload(); // Reload the page to update the table
        });
}

// Function to fetch total members, employees, and loans
function fetchAdminData() {
    fetch('fetch_admin_data.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total-members').textContent = data.total_members;
            document.getElementById('total-employees').textContent = data.total_employees;
            document.getElementById('total-loans').textContent = data.total_loans;
        });
}

document.getElementById('sidebarToggle').addEventListener('click', function () {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    sidebar.classList.toggle('collapsed');
    content.classList.toggle('collapsed');
});

const dropdowns = document.querySelectorAll('.dropdown');
dropdowns.forEach(dropdown => {
    dropdown.querySelector('.dropbtn').addEventListener('click', function() {
        const dropdownContent = dropdown.querySelector('.dropdown-content');
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    });
});


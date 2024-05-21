document.getElementById("role-select").addEventListener("change", function () {
        var roleSelect = this;
        var subRoleDiv = document.getElementById("sub-role-div");

        if (roleSelect.value === "Provider") {
            subRoleDiv.style.display = "block";
        } else {
            subRoleDiv.style.display = "none";
        }
    });
    
    
function redirectToHome() {
    // Replace with the URL for the hotel booking page
    window.location.href ='/';
}

function redirectToAboutUs() {
    // Replace with the URL for the hotel booking page
    window.location.href = '/about';
}

function redirectToHotelBooking() {
    // Replace with the URL for the hotel booking page
    window.location.href = '/book-hotel';
}

function redirectToEmergency() {
    // Replace with the URL for the hotel booking page
    window.location.href = '/emergency';
}

function redirectToRestaurantBooking() {
    // Replace with the URL for the restaurant booking page
    window.location.href = '/book-restaurant';
}

// function redirectToCabBooking() {
//     // Replace with the URL for the cab booking page
//     window.location.href = '/CabBooking';
// }

function redirectToProfile() {
    // Replace with the URL for the hotel booking page
    window.location.href = '/profile';
}

function redirectToLogout() {
    // Replace with the URL for the hotel booking page
    window.location.href = '/logging-out';
}

function redirectToLogin() {
    // Replace with the URL for the hotel booking page
    window.location.href = '/log-in';
}

function redirectToMeetpoint() {
    // Replace with the URL for the hotel booking page
    window.location.href = '/meeting-point';
}

function redirectToSignUp() {
    window.location.href = '/sign-up';
}
function redirectToUpdateProfile() {
    // Replace with the URL for the hotel booking page
    window.location.href = '/updateProfile';
}

function redirectToPay() {
    // Replace with the URL for the hotel booking page
    window.location.href = '/pay';
}

// function redirectToRoute() {
//     // Replace with the URL for the hotel booking page
//     window.location.href = 'route.php';
// }
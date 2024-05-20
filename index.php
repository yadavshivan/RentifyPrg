<?php include('includes/header.php'); ?>
<style>
    /* Styling for jumbotron */
.jumbotron {
    background: linear-gradient(135deg, #2980b9, #6ab0de);
    border-radius: 15px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    animation: fadeInDown 1s ease-in-out;
    color: #fff;
}

/* Animation for jumbotron */
@keyframes fadeInDown {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Styling for headings */
h1, h2 {
    color: #333;
}

/* Styling for paragraphs */
p {
    color: #666;
    transition: color 0.3s ease-in-out;
}

/* Hover effect for paragraphs */
p:hover {
    color: #444;
}

/* Styling for sections */
.container {
    margin-top: 20px;
}

/* Styling for column sections */
.col-md-6 {
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease-in-out;
}

/* Hover effect for column sections */
.col-md-6:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Styling for links */
a {
    color: #2980b9;
    transition: color 0.3s ease-in-out;
}

/* Hover effect for links */
a:hover {
    color: #6ab0de;
}

</style>
<!-- Main content area -->
<div class="container">
    <div class="jumbotron bg-primary text-light">
        <h1 class="display-4">Welcome to Rentify</h1>
        <p class="lead">Where Renting Meets Simplicity</p>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h2>About Rentify</h2>
            <p>Rentify is a platform that connects renters with property owners, making the renting process simple and efficient.</p>
            <p>With Rentify, you can easily find properties for rent, apply filters based on your preferences, and connect with property owners to schedule viewings.</p>
        </div>
        <div class="col-md-6">
            <h2>How It Works</h2>
            <p>1. Search for Properties: Use our intuitive search interface to find properties that meet your criteria.</p>
            <p>2. Apply Filters: Narrow down your search by applying filters based on location, price, amenities, and more.</p>
            <p>3. Connect with Owners: Once you find a property you're interested in, easily connect with the property owner to schedule a viewing or ask questions.</p>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<?php
    require_once 'functions.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mockup App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center" style="margin-bottom: 100px;">Mockup App</h1>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <!-- Api Form Start From Here -->
                    <form id="api-form">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" required checked>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subjects</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="math" value="Math">
                                    <label class="form-check-label" for="math">Math</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="physics" value="Physics">
                                    <label class="form-check-label" for="physics">Physics</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="chemistry" value="Chemistry">
                                    <label class="form-check-label" for="chemistry">Chemistry</label>
                                </div>
                                <small class="subject-message">Select atleast one subject.</small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <!-- Api Form End From Here -->
                     <!-- Api Response Message Start From Here -->
                     <div class="response-message" style="margin-top:20px; font-size: 18px;"></div>
                     <!-- Api Response Message End From Here -->
                </div>
                <div class="col-lg-8">
                    <!-- Api Enteris List Start From Here -->
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo get_data_via_api(); ?>
                        </tbody>
                    </table>
                    <!-- Api Enteris List End From Here -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="custom.js"></script>
</body>

</html>
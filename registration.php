<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Part 1 | Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/includes/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="admin/includes/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="admin/includes/assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="node_modules/face-api.js/dist/face-api.min.js"></script>
</head>

<body>
    <div class="container-fluid mt-3 mb-2">
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h3 class="card-title text-center">Create an Account</h3>
            </div>
            <form id="registrationForm" action="controllers/register.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <!-- User Information -->
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="fname" placeholder="First Name" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="mname" placeholder="Middle Name">
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="lname" placeholder="Last Name" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="phone" placeholder="Phone Number" required>
                            </div>
                            <div class="form-group mb-3">
                                <select name="gender" class="form-control" required>
                                    <option value="" selected disabled>Select your Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <input type="date" name="bdate" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <select name="civilstatus" class="form-control" required>
                                    <option value="" selected disabled>Select your Civil Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <!-- Job Info -->
                            <div class="form-group mb-3">
                                <input type="text" name="position" class="form-control" placeholder="Position" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="department" class="form-control" placeholder="Department" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="number" name="salary" class="form-control" placeholder="Salary" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="address" class="form-control" placeholder="Address" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="number" name="years" class="form-control" placeholder="Total Year in the Position" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="photo" class="form-label">Valid ID</label>
                                <input type="file" name="documentphoto" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <!-- Camera for Face Capture -->
                            <div class="camera" id="cameradaw" style="position:relative; width:100%; height: 300px; background-color: #eaeaea;"></div>
                            <canvas id="canvas" style="display:none; width:100%;"></canvas> <!-- Hidden canvas to capture the image -->
                            <input type="file" id="captureInput" name="capture" style="display:none;"> <!-- Hidden file input to upload the captured image -->
                            <a onclick="capture()" id="capture" class="btn btn-warning float-right">Capture</a>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" name="register" id="register" class="btn btn-success float-right">Save</button>
                    <button type="reset" class="btn btn-danger float-left">Clear</button>
                </div>
            </form>
        </div>
    </div>

    <!-- jQuery and Bootstrap scripts -->
    <script src="admin/includes/assets/plugins/jquery/jquery.min.js"></script>
    <script src="admin/includes/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="admin/includes/assets/dist/js/adminlte.min.js"></script>

    <script>
        document.getElementById('register').style.display = "none";
        // Wait for the DOM to load
        document.addEventListener("DOMContentLoaded", function() {
            const cameraDiv = document.querySelector('.camera'); // Get the camera div
            const canvas = document.getElementById('canvas');
            const captureInput = document.getElementById('captureInput');

            // Load the face-api.js models
            Promise.all([
                faceapi.nets.ssdMobilenetv1.loadFromUri('models'),
                faceapi.nets.faceLandmark68Net.loadFromUri('models'),
                faceapi.nets.faceRecognitionNet.loadFromUri('models')
            ]).then(startCamera);

            function startCamera() {
                if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                    navigator.mediaDevices.getUserMedia({
                            video: true
                        })
                        .then(function(stream) {
                            const video = document.createElement('video');
                            video.srcObject = stream;
                            video.autoplay = true;
                            video.style.width = "100%";
                            video.style.height = "100%";
                            cameraDiv.appendChild(video);

                            window.stream = stream;
                            window.videoElement = video;
                        })
                        .catch(function() {
                            alert("No camera support detected.");
                            window.location.href = 'registration';
                        });
                } else {
                    alert("No camera support detected.");
                    window.location.href = 'registration';
                }
            }

            // Capture image from the video feed
            // Capture image from the video feed
            window.capture = function() {
                const video = window.videoElement;
                const context = canvas.getContext('2d');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                canvas.style.display = "none"; // Show the captured image
                //hide the capture button
                document.getElementById('capture').style.display = "none";
                //hide cameradaw
                //hide the register button
                
                document.getElementById('cameradaw').style.display = "none";
                video.srcObject.getTracks().forEach(track => track.stop()); // Stop video stream
                video.style.display = "none"; // Hide video element

                canvas.toBlob(function(blob) {
                    const file = new File([blob], 'capture.png', {
                        type: 'image/png'
                    });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    captureInput.files = dataTransfer.files;

                    // Get face descriptor
                    faceapi.detectSingleFace(canvas).withFaceLandmarks().withFaceDescriptor()
                        .then(detection => {
                            if (detection) {
                                const faceDescriptor = detection.descriptor;
                                if (faceDescriptor) {
                                    console.log("Face descriptor generated: ", faceDescriptor); // Log the face descriptor

                                    // Send face descriptor to the server via FormData
                                    const formData = new FormData(document.getElementById('registrationForm'));
                                    formData.append('faceDescriptor', JSON.stringify(faceDescriptor)); // Append face descriptor to FormData

                                    // Send FormData to the server
                                    fetch('controllers/register.php', {
                                            method: 'POST',
                                            body: formData
                                        })
                                        .then(response => response.text()) // Change this to text to log raw response
                                        .then(data => {
                                            alert("Face Recognize");
                                            //check if the registration button is clicked
                                            document.getElementById('register').style.display = "block";

                                        
                                        })
                                        .catch(err => {
                                            console.error("Error in registration:", err); // Log any fetch-related errors
                                            alert('Error in registration: ' + err);
                                        });
                                } else {
                                    console.error("No face descriptor generated"); // Log error if face descriptor is missing
                                    alert('No face detected');
                                    //reload the page
                                    window.location.href = 'registration';
                                }
                            } else {
                                console.error("No face detected in the image"); // Log if no face detected
                                alert('No face detected');
                                //reload the page
                                window.location.href = 'registration';
                            }
                        })
                        .catch(err => {
                            console.error("Error in face-api.js face detection:", err); // Log error
                            alert('Error detecting face: ' + err);
                            //reload the page
                            window.location.href = 'registration';
                        });
                }, 'image/png');
            };

        });
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<?php
//get the specialorder
$specialorder = $_GET['specialorder'];

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Face Recognition with Camera</title>
    <script src="../node_modules/face-api.js/dist/face-api.min.js"></script>
    <style>
        .camera {
            width: 100%;
            height: 80vh;
            background-color: #eaeaea;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        video,
        canvas {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #canvas {
            display: none;
        }

        .controls {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Face Recognition</h1>
        <div class="camera">
            <video id="video" autoplay muted></video>
            <canvas id="canvas"></canvas>
        </div>
        <div class="controls">
            <button id="captureButton">Capture</button>
            <button id="startButton">Restart Camera</button>
        </div>
    </div>

    <script>
        // Elements
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const captureButton = document.getElementById('captureButton');
        const startButton = document.getElementById('startButton');

        // Load face-api.js models
        Promise.all([
            faceapi.nets.ssdMobilenetv1.loadFromUri('../models'),
            faceapi.nets.faceLandmark68Net.loadFromUri('../models'),
            faceapi.nets.faceRecognitionNet.loadFromUri('../models')
        ]).then(startCamera);

        // Start the webcam
        function startCamera() {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({
                        video: true
                    })
                    .then((stream) => {
                        video.srcObject = stream;
                    })
                    .catch((err) => {
                        console.error("Camera access denied:", err);
                        alert("Error accessing camera: " + err.message);
                    });
            } else {
                alert("Your browser does not support camera access.");
            }
        }

        // Capture the frame and process the face
        captureButton.addEventListener('click', async () => {
            const context = canvas.getContext('2d');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Detect face and get descriptor
            try {
                const detection = await faceapi.detectSingleFace(canvas).withFaceLandmarks().withFaceDescriptor();
                if (detection) {
                    const faceDescriptor = detection.descriptor;
                    console.log("Face Descriptor:", faceDescriptor);

                    // Send the face descriptor to the server for verification
                    fetch('verify_face.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `faceDescriptor=${JSON.stringify(faceDescriptor)}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === "success") {
                                alert(data.message); // Display success message
                            //redirect to controllers/applyloanverified.php with the specialorder
                            window.location.href = `controllers/applyloanverified.php?specialorder=<?php echo $specialorder; ?>`;
                            } else {
                                alert(data.message); // Display error message
                            }
                        })
                        .catch(err => {
                            console.error("Error during verification:", err);
                            alert("Error during verification.");
                        });

                } else {
                    alert("No face detected. Please try again.");
                }
            } catch (err) {
                console.error("Error detecting face:", err);
                alert("Error detecting face: " + err.message);
            }
        });

        // Restart the webcam
        startButton.addEventListener('click', () => {
            video.srcObject.getTracks().forEach((track) => track.stop());
            startCamera();
        });
    </script>
</body>

</html>
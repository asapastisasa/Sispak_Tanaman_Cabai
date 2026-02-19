<?php
// Include your database connection
include 'config.php';
date_default_timezone_set("Asia/Jakarta");

// Initialize session or other logic to keep track of current question
session_start();

// Check if it's the first question or if a question has been answered
$current_question_index = isset($_SESSION['current_question_index']) ? $_SESSION['current_question_index'] : 0;

if(isset($_POST['proses'])){
    $nmpengguna = $_POST['nmpengguna'];
    $tgl = date("Y/m/d");

    // Insert consultation information
    $sql = "INSERT INTO konsultasi (tanggal, nama_pengguna) VALUES ('$tgl', '$nmpengguna')";
    mysqli_query($conn, $sql);
    $idkonsultasi = mysqli_insert_id($conn);

    // Query to fetch questions (gejala) from database
    $sql_gejala = "SELECT * FROM gejala";
    $result_gejala = mysqli_query($conn, $sql_gejala);

    if ($result_gejala && mysqli_num_rows($result_gejala) > 0) {
        $questions = mysqli_fetch_all($result_gejala, MYSQLI_ASSOC);
        
        // Check if there are more questions to display
        if ($current_question_index < count($questions)) {
            // Get current question
            $current_question = $questions[$current_question_index];
            $idgejala = $current_question['idgejala'];
            $nmgejala = $current_question['nmgejala'];
            
            // Display current question
            echo "<form action='' method='POST'>";
            echo "<div class='card border-dark'>";
            echo "<div class='card-header bg-success text-white border-dark'><strong>Konsultasi Hama & Penyakit</strong></div>";
            echo "<div class='card-body'>";
            echo "<div class='form-group'>";
            echo "<label for='nmpengguna' style='font-size: 24px; font-weight: bold;'>Nama Pengguna</label>";
            echo "<input type='text' class='form-control' id='nmpengguna' name='nmpengguna' maxlength='50' required>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<label for='gejala_$idgejala'>Apakah tanaman mengalami $nmgejala?</label>";
            echo "<div>";
            echo "<button type='button' class='btn btn-primary' onclick='nextQuestion(\"ya\")'>Ya</button>";
            echo "<button type='button' class='btn btn-secondary ml-2' onclick='nextQuestion(\"tidak\")'>Tidak</button>";
            echo "</div>";
            echo "</div>";
            // Hidden fields to store consultation information
            echo "<input type='hidden' name='tgl' value='$tgl'>";
            echo "<input type='hidden' name='idkonsultasi' value='$idkonsultasi'>";
            echo "<input type='hidden' name='idgejala' value='$idgejala'>";

            // Submit button
            echo "<input class='btn btn-success' type='submit' name='proses' value='Simpan'>";
            echo "<a class='btn px-4 btn-danger ml-2' href='index.php' role='button'>Batal</a>";
            echo "</div>";
            echo "</div>";
            echo "</form>";

            // Update session to move to next question after submitting answer
            $_SESSION['current_question_index'] = $current_question_index + 1;
        } else {
            // All questions have been answered, redirect to result page
            header("Location: ?page=konsultasi&action=hasil&idkonsultasi=$idkonsultasi");
            exit();
        }
    } else {
        echo "Tidak ada gejala yang ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi Hama & Penyakit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap" rel="stylesheet">
    <style>
        .navbar-brand {
            font-size: 35px; 
            font-weight: bold; 
        }
        .question-heading {
            font-size: 20px; 
            font-weight: bold; 
            margin-bottom: 17px; 
        }
        .question-label {
            font-size: 17px; 
            font-weight: bold; 
        }
    </style>
</head>
<body>
<nav class="navbar py-2 navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="#">KONSULTASI</a>
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li>
                    <a class="btn px-4 btn-primary ml-2" href="index.php" role="button">Kembali</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="test mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 align-self-start">
                <form action="proses_konsultasi.php" method="POST" id="konsultasiForm">
                <div class="form-group">
                    <label for="nmpengguna" style="font-size: 20px; font-weight: bold;">Nama Pengguna</label>
                    <input type="text" class="form-control" id="nmpengguna" name="nmpengguna" maxlength="50" required
                        oninvalid="this.setCustomValidity('Isi Nama Pengguna')"
                        oninput="this.setCustomValidity('')">
                </div>                    
                <h2 class="question-heading mb-4">Pertanyaan:</h2>
                    <div id="questions-container"></div>
                    <input class="btn btn-success" type="submit" id="processBtn" style="display: none;" value="Proses">
                </form>
            </div>
            <div class="col-12 col-md-6 d-none d-sm-block">
                <img width="80%" src="gambar/petani.png" alt="hero">
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
    var currentQuestionIndex = 0;
    var allQuestions = [];
    var askedSymptoms = {}; // To track asked symptoms
    var skippedDiseases = {}; // To track skipped diseases
    var symptomDiseaseMap = {}; // Map of symptom to diseases

    // Fetch questions from the server
    $.ajax({
        url: 'get_questions.php',
        method: 'GET',
        success: function(data) {
            var questions = JSON.parse(data);
            // Build the map of symptom to diseases
            questions.forEach(question => {
                if (!symptomDiseaseMap[question.idgejala]) {
                    symptomDiseaseMap[question.idgejala] = [];
                }
                symptomDiseaseMap[question.idgejala].push(question.idpenyakit);
            });
            allQuestions = questions;
            displayQuestion();
        },
        error: function() {
            alert('Error fetching questions.');
        }
    });

    function displayQuestion() {
        while (currentQuestionIndex < allQuestions.length) {
            var question = allQuestions[currentQuestionIndex];
            if (!askedSymptoms[question.idgejala] && !skippedDiseases[question.idpenyakit]) {
                var questionHtml = `
                    <div class="form-group pertanyaan" id="pertanyaan${currentQuestionIndex}">
                        <label class="question-label">Apakah tanaman mengalami ${question.nmgejala}?</label><br>
                        <button type="button" class="btn btn-primary" onclick="nextQuestion('ya', ${currentQuestionIndex}, ${question.idgejala}, ${question.idpenyakit})">Ya</button>
                        <button type="button" class="btn btn-danger ml-2" onclick="nextQuestion('tidak', ${currentQuestionIndex}, ${question.idgejala}, ${question.idpenyakit})">Tidak</button>
                    </div>`;
                $('#questions-container').html(questionHtml);
                return; // break out of the function after displaying the question
            }
            currentQuestionIndex++;
        }

        $('#processBtn').show();
    }

    function nextQuestion(answer, index, idgejala, idpenyakit) {
        if (answer == 'tidak') {
            // Skip all diseases related to this symptom if not selected
            symptomDiseaseMap[idgejala].forEach(disease => {
                skippedDiseases[disease] = true;
            });
        }

        askedSymptoms[idgejala] = true; // Mark the symptom as asked

        $('<input>').attr({
            type: 'hidden',
            name: 'jawaban' + index,
            value: answer
        }).appendTo('#konsultasiForm');

        $('<input>').attr({
            type: 'hidden',
            name: 'idgejala' + index,
            value: idgejala
        }).appendTo('#konsultasiForm');

        currentQuestionIndex++;
        displayQuestion();
    }

    function processAnswers() {
        $('#processBtn').hide();
        $('#submitBtn').show();
    }
</script>

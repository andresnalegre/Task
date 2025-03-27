<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Country Info App</title>
    <link rel="stylesheet" href="libs/css/styles.css">
</head>
<body>
    <div id="preloader"></div>
    <div class="container">
        <h1>Country Information</h1>
        
        <div class="form-group">
            <label for="country">Select a Country:</label>
            <select id="country">
                <option value="AR">Argentina</option>
                <option value="BR">Brazil</option>
                <option value="IE">Ireland</option>
                <option value="FR">France</option>
                <option value="GB">United Kingdom</option>
            </select>
            <button id="getInfo">Get Info</button>
        </div>

        <div class="form-group">
            <label for="city">Select a City:</label>
            <select id="city">
                <option value="BA">Buenos Aires</option>
                <option value="SP">São Paulo</option>
                <option value="DU">Dublin</option>
                <option value="NY">New York</option>
                <option value="LD">London</option>
            </select>
            <button id="getCityInfo">Get City Info</button>
        </div>

        <div class="form-group">
            <label for="language">Select a Language:</label>
            <select id="language">
                <option value="EN">English UK</option>
                <option value="ES">Spanish</option>
                <option value="PT">Portuguese</option>
                <option value="FR">French</option>
                <option value="DE">German</option>
            </select>
            <button id="getLanguageInfo">Get Language Info</button>
        </div>

        <div id="loading" class="loading" style="display: none;">Loading...</div>
        <div id="result" class="result"></div>
    </div>
    <script src="libs/js/jquery-2.2.3.min.js"></script>
    <script src="libs/js/script.js"></script>
</body>
</html>
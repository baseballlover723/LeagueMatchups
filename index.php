<!DOCTYPE html>
<html>
<head lang="en">
    <?php
        include 'imports.php';
    ?>
    <link rel="stylesheet" href="stylesheets/index.css">
</head>
<body>
<?php
    include 'header.php';
?>
<div class="wrapper">
    <section>
        <div id="title">
            <h1>Leaguematchups</h1>

            <p>It analyzes matchups for League of Legends</p>
            <hr>
            <span class="credits left">Project maintained by <a href="https://github.com/baseballlover723">baseballlover723</a></span>
            <span class="credits right">Hosted on GitHub Pages &mdash; Theme by <a
                    href="https://twitter.com/michigangraham">mattgraham</a></span>
        </div>

        <h3>Welcome to GitHub Pages.</h3>

        <div id="lane-selector-box">
            <p>Select your lane:
                <select id="lane-selector">
                    <option value="top">Top</option>
                    <option value="mid">Mid</option>
                    <option value="adc">ADC</option>
                    <option value="support">Support</option>
                    <option value="jungle">Jungle</option>
                </select>
            </p>
        </div>
        <a href='#' class='button'>Get Results</a>

        <!--[if !IE]>
        <script>fixScale(document);</script><![endif]-->
</body>
</html>
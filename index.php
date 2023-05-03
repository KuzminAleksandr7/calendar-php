<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calendar</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Nunito', sans-serif;
        }

        body {
            height: 100vh;
            width: 100vw;
            background: linear-gradient(149deg, rgba(24, 187, 156, 1) 0%, rgba(106, 57, 175, 1) 42%, rgba(187, 24, 148, 1) 72%, rgba(115, 53, 134, 1) 100%);
            animation: gradient 10s infinite linear;
            background-size: 400%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes gradient {
            0% {
                background-position: 80% 0%;
            }
            50% {
                background-position: 20% 100%;
            }
            100% {
                background-position: 80% 0%;
            }
        }

        .box{
            width: 420px;
            padding: 20px;
            background-color: #727272;
            border-radius: 35px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 8px 8px 6px #00000029;
        }

        h1{
            margin-bottom: 16px;
            color: #2fbf2d;
            font-weight: 800;
        }

        table {
            table-layout: fixed;
            width: 350px;
            border: 2px solid #ffffff;
            border-radius: 15px;
            margin-bottom: 16px;
        }

        tr {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        thead{
            font-size: 20px;
            color: #ffffff;
        }

        .today {
            background-color: #276e26;
            border: 3px solid #2fbf2d;
            border-radius: 10px;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="box">
<?php
if (isset($_POST['year']) && isset($_POST['month'])) {
    $year = $_POST['year'];
    $month = $_POST['month'];
} else {
    $year = date('Y');
    $month = date('m');
}

$today = date('j');
$first_day = mktime(0, 0, 0, $month, 1, $year);
$total_days = date('t', $first_day);
$month_name = date('F', $first_day);
$day_of_week = date('w', $first_day);
?>
<h1><?php echo $month_name . ' ' . $year; ?></h1>
<table>
    <thead>
    <tr>
        <th>Sun</th>
        <th>Mon</th>
        <th>Tue</th>
        <th>Wed</th>
        <th>Thu</th>
        <th>Fri</th>
        <th>Sat</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php for ($i = 0; $i < $day_of_week; $i++): ?>
            <td></td>
        <?php endfor; ?>
        <?php
        $day_count = 1;
        while ($day_count <= $total_days) {
            if ($day_of_week == 7) {
                echo '</tr><tr>';
                $day_of_week = 0;
            }
            $class = '';
            if ($day_count == $today) {
                $class = 'today';
            }
            echo '<td class="' . $class . '">' . $day_count . '</td>';
            $day_count++;
            $day_of_week++;
        }
        while ($day_of_week < 7) {
            echo '<td></td>';
            $day_of_week++;
        } ?>
    </tr>
    </tbody>
</table>

<form method="post" action="">
    <label for="year">Year:</label>
    <input type="text" id="year" name="year" value="<?php echo $year ?>">
    <label for="month">Month:</label>
    <select id="month" name="month">
        <?php
        for ($m = 1; $m <= 12; $m++) {
            $month_name = date('F', mktime(0, 0, 0, $m, 1, $year));
            echo '<option value="' . $m . '"';
            if ($m == $month) {
                echo ' selected="selected"';
            }
            echo '>' . $month_name . '</option>';
        } ?>
    </select>
    <input type="submit" value="Go">
</form>
</div>
</body>
</html>

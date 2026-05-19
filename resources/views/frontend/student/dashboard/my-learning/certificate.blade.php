<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Certificate</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .certificate {
            width: 1123px;
            /* A4 landscape width */
            height: 794px;
            /* A4 landscape height */
            padding: 50px;
            box-sizing: border-box;
            background: #e9e9ea;
            position: relative;
            overflow: hidden;
        }

        .logo img {
            width: 120px;
        }

        .top-right {
            position: absolute;
            top: 40px;
            right: 60px;
            font-size: 12px;
            text-align: right;
        }

        .subtitle {
            margin-top: 70px;
            font-size: 14px;
            letter-spacing: 2px;
            color: #777;
        }

        .title {
            font-size: 48px;
            font-weight: bold;
            margin-top: 20px;
        }

        .instructor {
            margin-top: 20px;
            margin-bottom: 200px;
        }

        .student-name {
            margin-top: 80px;
            font-size: 36px;
            font-weight: bold;
        }

        .meta {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="certificate">

        <div class="logo">
            <img src="{{ public_path('assets/images/logo-light.png') }}">
        </div>


        <div class="subtitle">CERTIFICATE OF COMPLETION</div>

        <div class="title">
            {{ $data['courseTitle'] }}
        </div>

        <div class="instructor">
            Instructors <strong>{{ $data['instructorName'] }}</strong>
        </div>

        <div class="student-name">
            {{ $data['name'] }}
        </div>

        <div class="meta">
            Date <strong>{{ $data['date'] }}</strong>
        </div>

    </div>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container{
            max-width: 1140px;
            padding: 0 48px;
            margin: 20px auto;
            width: 90%;
        }

        .content_table-info{
            margin-left: 70%;
        }

        .content_table{
            margin-top: 10px;
        }
        .content_table-name{
            text-align: center;
            margin-top: 20px;
            margin-bottom: 30px;
        }
        .table_g {
            text-align: center;
            margin-bottom: 30px;
        }
        table, th, td {
            border: 1px solid black;
            font-size: 14px;
            text-align: center;
        }
        table {
            margin-top: 5px;
            margin-bottom: 30px;
            border-spacing: 0;
        }
        th, td{
            padding: 10px;
        }
    </style>
    <title>BMI</title>
</head>

<body>

<div class="wrapper">
    <div class="container">
        <div class="content_start">
            <div class="content_table">
                <div class="content_table-info">
                    <p>Muhammad al-Xorazmiy nomidagi <br> Tashkent axborot texnalogiyalari <br> universiteti Urganch
                        filalining <br> 2022-yil 22-dekabr 424-sonli <br> buyrug‘iga 1-ilova</p>
                </div>
                @foreach($filter_themes as $key => $value)
                    <div class="content_table-name">
                        <h3>{{ $now.'-'.$now+1 }} O‘quv yili Bakalavr {{ $key }}
                            -{{ \App\Services\SpecialtyService::getSpecialtyForId($key)->name }} yo‘nalishi
                            bitiruvchilarining <br> bitiruv malakaviy ish mavzulari</h3>
                    </div>
                    @foreach($value as $group_id => $item)
                        <h3 class="table_g">{{ $group_id }} guruh</h3>
                        <div class="content_table-start">
                            <table style="width:100%">
                                <tr>
                                    <th>T/r</th>
                                    <th style="width: 25%"> TALABA F.I.SH</th>
                                    <th style="width: 25%">BMI MAVZUSI</th>
                                    <th style="width: 25%">RAHBAR F.I.SH</th>
                                    <th style="width: 25%">MASLAHATCHI F.I.SH
                                </tr>
                                @foreach($item as $theme)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $theme->student_name }}</td>
                                        <td>
                                            {{ $theme->name }}
                                        </td>
                                        <td>
                                            {{  \App\Services\EmployeeService::getEmployeeForId($theme->teacher_id)->department->name }} kafedrasi
                                            <br>
                                            {{  \App\Services\EmployeeService::getEmployeeForId($theme->teacher_id)->staffPosition->name }} o'qituvchisi
                                            {{ \App\Services\EmployeeService::getEmployeeForId($theme->teacher_id)->short_name }}
                                        </td>
                                        <td>
                                            {{ $theme->second_teacher }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>

</body>

</html>

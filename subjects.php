<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$year = $_GET['year'] ?? '';
$branch = $_GET['branch'] ?? '';

// Define subjects with individual PDFs for Notes, PYQ, and Videos
$subjects = [
    "FE" => [
        "Sem I" => [
            ["name" => "Mathematics I", "notes" => "math1_notes.pdf", "pyq" => "math1_pyq.pdf", "videos" => "math1_videos.pdf"],
            ["name" => "Physics", "notes" => "physics_notes.pdf", "pyq" => "physics_pyq.pdf", "videos" => "physics_videos.pdf"],
            ["name" => "Chemistry", "notes" => "chem_notes.pdf", "pyq" => "chem_pyq.pdf", "videos" => "chem_videos.pdf"],
            ["name" => "Engineering Mechanics", "notes" => "em_notes.pdf", "pyq" => "em_pyq.pdf", "videos" => "em_videos.pdf"],
            ["name" => "Engineering Graphics", "notes" => "eg_notes.pdf", "pyq" => "eg_pyq.pdf", "videos" => "eg_videos.pdf"]
        ],
        "Sem II" => [
            ["name" => "Mathematics II", "notes" => "math2_notes.pdf", "pyq" => "math2_pyq.pdf", "videos" => "math2_videos.pdf"],
            ["name" => "Basic Electrical Engineering", "notes" => "bee_notes.pdf", "pyq" => "bee_pyq.pdf", "videos" => "bee_videos.pdf"],
            ["name" => "Basic Electronics Engineering", "notes" => "beelect_notes.pdf", "pyq" => "beelect_pyq.pdf", "videos" => "beelect_videos.pdf"],
            ["name" => "fundamental of problem solving", "notes" => "fpl_notes.pdf", "pyq" => "fpl_pyq.pdf", "videos" => "fpl_videos.pdf"],
            ["name" => "Problem Solving and Programming", "notes" => "pps_notes.pdf", "pyq" => "pps_pyq.pdf", "videos" => "pps_videos.pdf"]
        ]
    ],

    "SE" => [
        "IT" => [
            "Sem III" => [
                ["name" => "DSA", "notes" => "dsa_notes.pdf", "pyq" => "dsa_pyq.pdf", "videos" => "dsa_videos.pdf"],
                ["name" => "OOP", "notes" => "oop_notes.pdf", "pyq" => "oop_pyq.pdf", "videos" => "oop_videos.pdf"],
                ["name" => "BCN", "notes" => "bcn_notes.pdf", "pyq" => "bcn_pyq.pdf", "videos" => "bcn_videos.pdf"],
                ["name" => "DELD", "notes" => "DELD_notes.pdf", "pyq" => "DELD_pyq.pdf", "videos" => "DELD_videos.pdf"],
                ["name" => "DGM", "notes" => "DGM_notes.pdf", "pyq" => "DGM_pyq.pdf", "videos" => "DGM_videos.pdf"],
                ["name" => "UHV", "notes" => "UHV_notes.pdf", "pyq" => "UHV_pyq.pdf", "videos" => "UHV_videos.pdf"]
            ],
            "Sem IV" => [
                ["name" => "Database Management System", "notes" => "dbms_notes.pdf", "pyq" => "dbms_pyq.pdf", "videos" => "dbms_videos.pdf"],
                ["name" => "computer graphics", "notes" => "cg_notes.pdf", "pyq" => "cg_pyq.pdf", "videos" => "cg_videos.pdf"],
                ["name" => "probability and statistics", "notes" => "ps_notes.pdf", "pyq" => "ps_pyq.pdf", "videos" => "ps_videos.pdf"],
                ["name" => "processor architecture", "notes" => "pa_notes.pdf", "pyq" => "pa_pyq.pdf", "videos" => "pa_videos.pdf"],
                ["name" => "digital marketing and social media", "notes" => "dmsm_notes.pdf", "pyq" => "dmsm_pyq.pdf", "videos" => "dmsm_videos.pdf"],
                ["name" => "modern indian language(marathi)", "notes" => "mil_notes.pdf", "pyq" => "mil_pyq.pdf", "videos" => "mil_videos.pdf"],
            ]
        ],
        "CE" => [
            "Sem III" => [
                ["name" => "ABL", "notes" => "abl_notes.pdf", "pyq" => "abl_pyq.pdf", "videos" => "abl_videos.pdf"],
                ["name" => "DEF", "notes" => "def_notes.pdf", "pyq" => "def_pyq.pdf", "videos" => "def_videos.pdf"]
            ],
            "Sem IV" => [
                ["name" => "ABC", "notes" => "abc_notes.pdf", "pyq" => "abc_pyq.pdf", "videos" => "abc_videos.pdf"],
                ["name" => "XYZ", "notes" => "xyz_notes.pdf", "pyq" => "xyz_pyq.pdf", "videos" => "xyz_videos.pdf"]
            ]
        ],
        "electrical engineering" => [
            "Sem III" => [
                ["name" => "Electrical Measurements & Instrumentation", "notes" => "emi_notes.pdf", "pyq" => "emi_pyq.pdf", "videos" => "emi_videos.pdf"],
                ["name" => "Analog and digital Electronics", "notes" => "ade_notes.pdf", "pyq" => "ade_pyq.pdf", "videos" => "ade_videos.pdf"],
                ["name" => "Power System Engineering-I", "notes" => "pse_notes.pdf", "pyq" => "pse_pyq.pdf", "videos" => "pse_videos.pdf"],
                ["name" => "Engineering Mathematics-III", "notes" => "em3_notes.pdf", "pyq" => "em3_pyq.pdf", "videos" => "em3_videos.pdf"]
            ],
            "Sem IV" => [
                ["name" => "Electrical Machines-1", "notes" => "eml1_notes.pdf", "pyq" => "eml1_pyq.pdf", "videos" => "eml1_videos.pdf"],
                ["name" => "Numerical Methods and Computer Programming", "notes" => "nmcp_notes.pdf", "pyq" => "nmcp_pyq.pdf", "videos" => "nmcp_videos.pdf"],
                ["name" => "Network Analysis", "notes" => "na_notes.pdf", "pyq" => "na_pyq.pdf", "videos" => "na_videos.pdf"],
                ["name" => "Basics of Electrical Machines for Electric Vehicle-I", "notes" => "beme_notes.pdf", "pyq" => "beme_pyq.pdf", "videos" => "beme_videos.pdf"]
            ]
        ],
    ],

    "TE" => [
        "IT" => [
            "Sem V" => [
                ["name" => "AI", "notes" => "ai_notes.pdf", "pyq" => "ai_pyq.pdf", "videos" => "ai_videos.pdf"],
                ["name" => "ML", "notes" => "ml_notes.pdf", "pyq" => "ml_pyq.pdf", "videos" => "ml_videos.pdf"],
                ["name" => "IoT", "notes" => "iot_notes.pdf", "pyq" => "iot_pyq.pdf", "videos" => "iot_videos.pdf"]
            ],
            "Sem VI" => [
                ["name" => "SPOS", "notes" => "spos_notes.pdf", "pyq" => "spos_pyq.pdf", "videos" => "spos_videos.pdf"],
                ["name" => "CN", "notes" => "cn_notes.pdf", "pyq" => "cn_pyq.pdf", "videos" => "cn_videos.pdf"],
                ["name" => "SEPM", "notes" => "sepm_notes.pdf", "pyq" => "sepm_pyq.pdf", "videos" => "sepm_videos.pdf"]
            ]
        ],
        "CE" => [
            "Sem V" => [
                ["name" => "WEB", "notes" => "web_notes.pdf", "pyq" => "web_pyq.pdf", "videos" => "web_videos.pdf"],
                ["name" => "DBMS-II", "notes" => "dbms2_notes.pdf", "pyq" => "dbms2_pyq.pdf", "videos" => "dbms2_videos.pdf"]
            ],
            "Sem VI" => [
                ["name" => "CLOUD", "notes" => "cloud_notes.pdf", "pyq" => "cloud_pyq.pdf", "videos" => "cloud_videos.pdf"],
                ["name" => "AI", "notes" => "ai_notes_ce.pdf", "pyq" => "ai_pyq_ce.pdf", "videos" => "ai_videos_ce.pdf"]
            ]
        ]
    ],

    "BE" => [
        "IT" => [
            "Sem VII" => [
                ["name" => "AI & DS", "notes" => "aids_notes.pdf", "pyq" => "aids_pyq.pdf", "videos" => "aids_videos.pdf"],
                ["name" => "Blockchain", "notes" => "blockchain_notes.pdf", "pyq" => "blockchain_pyq.pdf", "videos" => "blockchain_videos.pdf"],
                ["name" => "Project I", "notes" => "project1_notes.pdf", "pyq" => "project1_pyq.pdf", "videos" => "project1_videos.pdf"]
            ],
            "Sem VIII" => [
                ["name" => "DevOps", "notes" => "devops_notes.pdf", "pyq" => "devops_pyq.pdf", "videos" => "devops_videos.pdf"],
                ["name" => "Cloud Native", "notes" => "cloudnative_notes.pdf", "pyq" => "cloudnative_pyq.pdf", "videos" => "cloudnative_videos.pdf"],
                ["name" => "Project II", "notes" => "project2_notes.pdf", "pyq" => "project2_pyq.pdf", "videos" => "project2_videos.pdf"]
            ]
        ],
        "CE" => [
            "Sem VII" => [
                ["name" => "ML", "notes" => "ml_notes_ce.pdf", "pyq" => "ml_pyq_ce.pdf", "videos" => "ml_videos_ce.pdf"],
                ["name" => "AI", "notes" => "ai_notes_ce.pdf", "pyq" => "ai_pyq_ce.pdf", "videos" => "ai_videos_ce.pdf"],
                ["name" => "DS", "notes" => "ds_notes_ce.pdf", "pyq" => "ds_pyq_ce.pdf", "videos" => "ds_videos_ce.pdf"]
            ],
            "Sem VIII" => [
                ["name" => "NLP", "notes" => "nlp_notes.pdf", "pyq" => "nlp_pyq.pdf", "videos" => "nlp_videos.pdf"],
                ["name" => "Cloud", "notes" => "cloud_notes_ce.pdf", "pyq" => "cloud_pyq_ce.pdf", "videos" => "cloud_videos_ce.pdf"],
                ["name" => "Project II", "notes" => "project2_notes_ce.pdf", "pyq" => "project2_pyq_ce.pdf", "videos" => "project2_videos_ce.pdf"]
            ]
        ]
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $year . " " . $branch; ?> Subjects</title>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    margin: 0;
    padding: 0;
}
.container {
    background: rgba(0,0,0,0.6);
    border-radius: 20px;
    padding: 40px;
    width: 70%;
    margin: 60px auto;
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
}
h2, h3 { text-align: center; }
ul { list-style-type: square; margin-left: 50px; }
a {
    display: inline-block;
    background: rgba(255,255,255,0.2);
    color: #38f9d7;
    padding: 6px 12px;
    border-radius: 8px;
    text-decoration: none;
    margin-right: 8px;
    transition: 0.3s;
}
a:hover { background: white; color: #000; }
</style>
</head>
<body>
<div class="container">
<h2><?php echo $year . " " . ($branch ?: ""); ?> - Subjects</h2>

<?php
if ($year == "FE") {

    echo "<h3>First Year (FE)</h3>";
    echo "<h4>Sem I</h4><ul>";

    echo "<li>Mathematics I
        <a href='uploads/math1_notes.pdf' target='_blank'>Notes</a>
        <a href='uploads/FE/m1notes.pdf' target='_blank'>PYQ</a>
        <a href='https://www.youtube.com/@pradeepgiriacademy' target='_blank'>Videos</a>
    </li>";

    echo "<li>Physics
        <a href='uploads/physics_notes.pdf' target='_blank'>Notes</a>
        <a href='uploads/physics_pyq.pdf' target='_blank'>PYQ</a>
        <a href='https://youtu.be/E-Lr3_LGTeY?list=PLnU_6InKwomFPUn1k5np6NtnoU38TW2PT' target='_blank'>Videos</a>
    </li>";

    echo "<li>Chemistry
        <a href='uploads/chem_notes.pdf' target='_blank'>Notes</a>
        <a href='uploads/chem_pyq.pdf' target='_blank'>PYQ</a>
        <a href='https://youtu.be/-rXeFFGanlM?list=PLg2LVpcRrOF6Sn9UO_1Yict2fJYKuQQHN' target='_blank'>Videos</a>
    </li>";

    echo "<li>Engineering Mechanics
        <a href='uploads/em_notes.pdf' target='_blank'>Notes</a>
        <a href='uploads/em_pyq.pdf' target='_blank'>PYQ</a>
        <a href='https://www.youtube.com/@pradeepgiriacademy' target='_blank'>Videos</a>
    </li>";

    echo "<li>Engineering Graphics
        <a href='uploads/eg_notes.pdf' target='_blank'>Notes</a>
        <a href='uploads/eg_pyq.pdf' target='_blank'>PYQ</a>
        <a href='https://youtu.be/7JpSSBVeSpI?list=PLDN15nk5uLiBpnIOK5r3KXdfFOVzGHJSt' target='_blank'>Videos</a>
    </li>";

    echo "</ul><h4>Sem II</h4><ul>";

    echo "<li>Mathematics II
        <a href='uploads/math2_notes.pdf' target='_blank'>Notes</a>
        <a href='uploads/math2_pyq.pdf' target='_blank'>PYQ</a>
        <a href='https://www.youtube.com/@pradeepgiriacademy' target='_blank'>Videos</a>
    </li>";

    echo "<li>Basic Electrical Engineering
        <a href='uploads/FE\BEE Unit-II .pdf' target='_blank'>Notes</a>
        <a href='uploads/FE\BEE Question Bank.pdf' target='_blank'>PYQ</a>
        <a href='https://www.youtube.com/watch?v=-Mo4-doXU0Q&list=PL0s3O6GgLL5cLAfoALo36QVhy1oM5NZsP' target='_blank'>Videos</a>
    </li>";

    echo "<li>Basic Electronics Engineering
        <a href='uploads/beelect_notes.pdf' target='_blank'>Notes</a>
        <a href='uploads/beelect_pyq.pdf' target='_blank'>PYQ</a>
        <a href='https://www.youtube.com/watch?v=0Ax4TtQS1Vg&list=PLsUUaB1EBeQ1uCuyPD8f-Qqo1tQoEEsJ2' target='_blank'>Videos</a>
    </li>";

    echo "<li>fundamental of problemsolving
        <a href='uploads/python_notes.pdf' target='_blank'>Notes</a>
        <a href='uploads/python_pyq.pdf' target='_blank'>PYQ</a>
        <a href='https://www.youtube.com/watch?v=Fskgvn3nZ0E&list=PLpsKX9KpvMuRauQfy8Jb-gkWzvqVkh7me' target='_blank'>Videos</a>
    </li>";

    echo "<li>Programming and problem solving
        <a href='uploads\FE\PPS units 1.pdf' target='_blank'>Notes</a>
        <a href='uploads/comm_pyq.pdf' target='_blank'>PYQ</a>
        <a href='https://www.youtube.com/watch?v=8GrMwZOZwVc&list=PLpsKX9KpvMuS8K0zVJuZbBLC1o2ntrD1_' target='_blank'>Videos</a>
    </li>";

    echo "</ul>";

} elseif ($year == "SE") {

    echo "<h3>Second Year (SE)</h3>";
    echo "<h4>Sem III</h4><ul>";

    echo "<li>Data Structures and Algorithms
        <a href='uploads/SE\DSA.pdf' target='_blank'>Notes</a>
        <a href='uploads/dsa_pyq.pdf' target='_blank'>PYQ</a>
        <a href='https://www.youtube.com/watch?v=-D5u5HJbISc&list=PLqleLpAMfxGAf5rrWdm92WMK3-gsrxgz5' target='_blank'>Videos</a>
    </li>";

    echo "<li>deld
        <a href='uploads/de_notes.pdf' target='_blank'>Notes</a>
        <a href='uploads/de_pyq.pdf' target='_blank'>PYQ</a>
        <a href='https://www.youtube.com/watch?v=_mtNlutd8ok&pp=ygUEZGVsZA%3D%3D' target='_blank'>Videos</a>
    </li>";

    echo "<li>Object Oriented Programming
        <a href='uploads/oop_notes.pdf' target='_blank'>Notes</a>
        <a href='uploads/oop_pyq.pdf' target='_blank'>PYQ</a>
        <a href='https://www.youtube.com/watch?v=bSrm9RXwBaI&pp=ygULb29wIGluIGphdmE%3D' target='_blank'>Videos</a>
    </li>";

    echo "<li>bcn
        <a href='uploads\SE\BCN UNIT 1.pdf' target='_blank'>Notes</a>
        <a href='uploads/cg_pyq.pdf' target='_blank'>PYQ</a>
        <a href='https://www.youtube.com/watch?v=-80MVFS5wHk&list=PLqleLpAMfxGCUpDRFUnLKeDrgBsPOwTQK' target='_blank'>Videos</a>
    </li>";

    echo "<li>dgm
        <a href='uploads\SE\dgm.pdf' target='_blank'>Notes</a>
        <a href='uploads/dm_pyq.pdf' target='_blank'>PYQ</a>
        <a href='uploads/dm_videos.pdf' target='_blank'>Videos</a>
    </li>";

    echo "</ul><h4>Sem IV</h4><ul>";

    echo "<li>Database Management Systems
        <a href='uploads/dbms_notes.pdf' target='_blank'>Notes</a>
        <a href='uploads/dbms_pyq.pdf' target='_blank'>PYQ</a>
        <a href='uploads/dbms_videos.pdf' target='_blank'>Videos</a>
    </li>";

    echo "<li>Computer Networks
        <a href='uploads/cn_notes.pdf' target='_blank'>Notes</a>
        <a href='uploads/cn_pyq.pdf' target='_blank'>PYQ</a>
        <a href='uploads/cn_videos.pdf' target='_blank'>Videos</a>
    </li>";

    echo "<li>Operating Systems
        <a href='uploads/os_notes.pdf' target='_blank'>Notes</a>
        <a href='uploads/os_pyq.pdf' target='_blank'>PYQ</a>
        <a href='uploads/os_videos.pdf' target='_blank'>Videos</a>
    </li>";

    echo "<li>Microprocessor and Interfacing
        <a href='uploads/mp_notes.pdf' target='_blank'>Notes</a>
        <a href='uploads/mp_pyq.pdf' target='_blank'>PYQ</a>
        <a href='uploads/mp_videos.pdf' target='_blank'>Videos</a>
    </li>";

    echo "<li>Data Science
        <a href='uploads/ds_notes.pdf' target='_blank'>Notes</a>
        <a href='uploads/ds_pyq.pdf' target='_blank'>PYQ</a>
        <a href='uploads/ds_videos.pdf' target='_blank'>Videos</a>
    </li>";

    echo "</ul>";

} else {
    echo "<p style='text-align:center;'>No subjects found for this branch.</p>";
}
?>

<a href="choseyear.php">Back</a> | 
<a href="logout.php">Logout</a>
</div>
</body>
</html>

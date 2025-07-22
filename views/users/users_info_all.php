<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\User[] $model */

$this->title = 'Your Information';
$this->registerJsFile(
    'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js',
    ['position' => \yii\web\View::POS_END]
);
$this->registerJsFile(
    'https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js',
    ['position' => \yii\web\View::POS_END]
);
?>

<head>
    <!-- Ensure Bootstrap and Font Awesome are included -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<div class="user-info">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="d-flex justify-content-end mb-3">
        <div class="dropdown">
            <button class="btn btn-success dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-file-export"></i> Export
            </button>
            <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                <li><a class="dropdown-item" href="#" id="exportPdf">Export as PDF</a></li>
                <li><a class="dropdown-item" href="#" id="exportExcel">Export as Excel</a></li>
            </ul>
        </div>
    </div>



    <?php if (!empty($model)): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($model as $user): ?>
                        <tr>
                            <td><?= Html::encode($user->first_name . ' ' . $user->last_name) ?></td>
                            <td><?= Html::encode($user->gender) ?></td>
                            <td><?= Html::encode($user->email) ?></td>
                            <td><?= Html::encode($user->phone_number) ?></td>
                            <td>
                                <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'id' => $user->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= Html::a('<i class="fas fa-trash-alt"></i>', ['delete', 'id' => $user->id], [
                                    'class' => 'btn btn-danger btn-sm',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this user?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p>No user information found.</p>
    <?php endif; ?>
</div>


<?php
// JavaScript for exporting to PDF and Excel
$exportScript = <<<JS
document.getElementById("exportPdf").addEventListener("click", function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const head = [['Name', 'Gender', 'Email', 'Phone Number']];
    const body = [];

    const rows = document.querySelectorAll("table tbody tr");
    rows.forEach(row => {
        const cells = row.querySelectorAll("td");
        const rowData = [
            cells[0]?.innerText || '',
            cells[1]?.innerText || '',
            cells[2]?.innerText || '',
            cells[3]?.innerText || ''
        ];
        body.push(rowData);
    });

    doc.autoTable({
        head: head,
        body: body,
        theme: 'striped',
        headStyles: { fillColor: [52, 58, 64] },
        margin: { top: 20 },
    });

    doc.save("user-information.pdf");
    doc.save("user-information.pdf");
location.reload(); // reloads the page

});


// Excel export
document.getElementById("exportExcel").addEventListener("click", function () {
    const rows = document.querySelectorAll("table tbody tr");
    let csv = "Name,Gender,Email,Phone Number\\n";

    rows.forEach(row => {
        const cells = row.querySelectorAll("td");
        const rowData = [
            cells[0]?.innerText || '',
            cells[1]?.innerText || '',
            cells[2]?.innerText || '',
            cells[3]?.innerText || ''
        ];
        csv += rowData.join(",") + "\\n";
    });

    const blob = new Blob([csv], { type: "text/csv;charset=utf-8;" });
    const link = document.createElement("a");
    const url = URL.createObjectURL(blob);

    link.setAttribute("href", url);
    link.setAttribute("download", "user-information.csv");
    link.style.visibility = "hidden";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    document.body.removeChild(link);
    location.reload();
});
JS;

$this->registerJs($exportScript, \yii\web\View::POS_END);
?>
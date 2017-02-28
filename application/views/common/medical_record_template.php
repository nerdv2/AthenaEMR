<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>LABRESULT</title>
    
    <style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="<?php echo base_url("assets/img/logo_transparent.png"); ?>" style="width:100%; max-width:300px;">
                            </td>
                            
                            <td>
                                
                                Created: <?php echo date("F d, Y") ?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                AthenaEMR, Inc.<br>
                                12345 Sunny Road<br>
                                Sunnyville, TX 12345
                            </td>
                            
                            <td>
                            
                                <?php echo $patientid; ?><br>
                                <?php echo $patientname; ?>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

        </table>
        <?php foreach($query as $row): ?>
            
            <?php echo $row->time; ?> \ <?php echo $row->record_id; ?> \ <?php echo $row->doctor_name; ?><br>
            <table border='1'>
            <tr>
                <td width="20%">Complaint: </td>
                <td><?php echo $row->complaint; ?></td>
            </tr>
            <tr>
                <td>Symptoms: </td>
                <td><?php echo $row->symptoms; ?></td>
            </tr>
            <tr>
                <td>Diagnosis: </td>
                <td><?php echo $row->diagnosis; ?></td>
            </tr>
            <tr>
                <td>Handling: </td>
                <td><?php echo $row->handling; ?></td>
            </tr>
            </table>
            <?php 
                if($row->prescription_id === null && $row->lab_id === null){
                    
                } elseif($row->prescription_id === null) {
                    echo $row->lab_id . " \ " . $row->result_id;
                } else {
                    ?>
                    <?php echo $row->prescription_id; ?> \  <?php echo $row->lab_id; ?> \ <?php echo $row->result_id; ?>
                    <?php
                }
            ?>
            
            <br><br>
            <?php endforeach; ?>
    </div>
</body>
</html>
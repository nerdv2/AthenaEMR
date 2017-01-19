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
                                

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <?php
                $template = array('table_open' => '<table cellspacing="0" width="100%">');
                $this->table->set_template($template);

                $cell_add = array('data' => '<a href="'.site_url().'/registration/adddata">Add New Data</a>', 'class' => 'highlight', 'colspan' => 2);

                $this->table->set_heading('RegisterID','WorkerID','PatientID','Type','Time of Register','Entry Number','');
                foreach($query as $row){
                    $edit = "<a href='".site_url()."/athenaReport/get_entry/".$row->register_id."' title='".$row->register_id."'>Print Entry</a>
                    <br>
                    <a href='".site_url()."/registration/deletedata/".$row->register_id."' title='".$row->patient_id."' onclick='return confirmDelete();'>Delete</a>"; 
                    $this->table->add_row($row->register_id, $row->worker_id, $row->patient_id, $row->category, $row->time, $row->entry_no);
                }
                echo $this->table->generate();
        ?>
        </table>
    </div>
</body>
</html>
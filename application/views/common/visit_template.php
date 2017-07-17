<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>PATIENT VISIT INFO</title>
    
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
                                <?= $setting->hospital_name; ?><br>
                                <?= $setting->hospital_address; ?><br>
                                <?= $setting->hospital_phone; ?><br>
                                <?= $setting->hospital_email; ?>
                            </td>
                            
                            <td>
                                    <?= $doctor; ?>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <?php
                $template = array(
                        'table_open'            => '<table border="1" cellpadding="4" cellspacing="0">',

                        'thead_open'            => '<thead>',
                        'thead_close'           => '</thead>',

                        'heading_row_start'     => '<tr>',
                        'heading_row_end'       => '</tr>',
                        'heading_cell_start'    => '<th>',
                        'heading_cell_end'      => '</th>',

                        'tbody_open'            => '<tbody>',
                        'tbody_close'           => '</tbody>',

                        'row_start'             => '<tr>',
                        'row_end'               => '</tr>',
                        'cell_start'            => '<td align="center" valign="center">',
                        'cell_end'              => '</td>',

                        'row_alt_start'         => '<tr>',
                        'row_alt_end'           => '</tr>',
                        'cell_alt_start'        => '<td align="center" valign="center">',
                        'cell_alt_end'          => '</td>',

                        'table_close'           => '</table>'
                );
                $this->table->set_template($template);
                $this->table->set_heading('Date of Visit','Patient Name');
                foreach($query as $row){
                    $this->table->add_row($row->Date, $row->Name);
                }
                echo $this->table->generate();
        ?>
        </table>
    </div>
</body>
</html>
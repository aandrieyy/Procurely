<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Purchase_order_library
{

    public $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->model('purchases_model');
        $this->CI->load->model('suppliers_model');
    }

    public function pdf_po($id_purchase){
        $purchase = $this->CI->purchases_model->get($id_purchase)->row();
        $supplier = $this->CI->suppliers_model->get($purchase->id_supplier)->row();
        $purchase_details = $this->CI->purchases_model->get_purchase_details($id_purchase)->result();
        $po_details = '';

        if(isset($supplier)){
            $name = $supplier->name;
            $bs_address = $supplier->bs_address;
            $bs_telephone = $supplier->bs_telephone;
            $bs_phone = $supplier->bs_phone;
            $bs_email = $supplier->bs_email;
        }else{
            $name = '';
            $bs_address = '';
            $bs_telephone = '';
            $bs_phone = '';
            $bs_email = '';
        }

        // print_r($supplier);die('x');
        foreach($purchase_details as $row){
            $po_details .= '
                <tr>
                    <td  border="1">'.$row->product_name.'('.$row->brand.')</td>
                    <td  border="1">'.$row->qty.'</td>
                    <td  border="1">'.number_format($row->unit_price,2).'</td>
                    <td  border="1">'.number_format($row->total,2).'</td>
                </tr>
            '; 
        }


        $text = ' 
        <table style="width:100%;">
            <tr>
                <td width="60%" rowspan="5"><img src="public/assets/img/logo.png" style="width:300px"></td>
                <td width="40%" colspan="2" style="vertical-align: middle;"><h1><b>Purchase Order</b></h1></td>
            </tr>
            <tr>
                <td width="15%">Date</td>
                <td width="25%" border="1">'.$purchase->date.'</td>
            </tr>
            <tr>
                <td width="15%">P.O Number</td>
                <td width="25%" border="1">'.$purchase->po_nos.'</td>
            </tr>
            <tr>
                <td width="15%">Customer ID</td>
                <td width="25%" border="1"></td>
            </tr>
        </table>

        <br><br>

        <table>
            <tr>
                <td style="background-color:#999999">Vendor</td>
                <td></td>
                <td style="background-color:#999999">Ship To</td>
            </tr>
            <tr>
                <td style="font-size:9px;">
                    '.$name.'	<br>	
                    '.$bs_address.'	<br>			
                    '.$bs_telephone.' <br>		
                    '.$bs_phone.' <br>		
                    '.$bs_email.'	
                </td> 

                <td style="font-size:9px;">
                </td> 

                <td style="font-size:9px;">
                    '.$purchase->employee1.' <br>		
                    THINKWOLI SYSTEMS INTEGRATORS, INC. <br>	
                    3/F CK Bldg 61 Visayas Ave <br>		
                    Proj. 6 Brgy. Vasra Quezon City 1100 <br>		
                    (02)275-5225 <br>		
                    09426539472/09951218617 <br>		
                    www.thinkwoli.com.ph <br>		                
                </td> 
            </tr>
        </table>

        <br><br>
        
        <table>
            <tr>
                <td style="background-color:#999999">Ship Via</td>
                <td style="background-color:#999999">Shipping Method</td>
                <td style="background-color:#999999">Shipping Terms</td>
                <td style="background-color:#999999">Delivery Date</td>
            </tr>
            <tr>
                <td border="1">'.$purchase->courier.'</td>
                <td border="1">'.$purchase->shipping_method.'</td>
                <td border="1">'.$purchase->shipping_terms.'</td>
                <td border="1">'.$purchase->delivery_date.'</td>
            </tr>
        </table>

        <br><br>

        <table cellpadding="2">
            <tr>
                <td width="51%" style="background-color:#999999">Product Name/Description</td>
                <td width="15%" style="background-color:#999999">Quantity</td>
                <td width="17%" style="background-color:#999999">Unit Price</td>
                <td width="17%" style="background-color:#999999">Total</td>
            </tr>
           '.$po_details.'
            <tr>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
            </tr>
            <tr>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
            </tr>
            <tr>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
            </tr>
            <tr>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
            </tr>
            <tr>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
            </tr>
            <tr>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
                <td  border="1"></td>
            </tr>
        </table>

        <table>
            <tr>
                <td width="11%"></td>
                <td width="40%"></td>
                <td width="15%"></td>
                <td width="17%">Subtotal</td>
                <td width="17%" border="1"> PHP '.number_format($purchase->subtotal,2).'</td>
            </tr>
            <tr>
                <td width="11%"></td>
                <td width="40%"></td>
                <td width="15%"></td>
                <td width="17%">Less 1% W/H</td>
                <td width="17%" border="1"> PHP '.number_format($purchase->wh,2).'</td>
            </tr>
            <tr>
                <td width="11%"></td>
                <td width="40%"></td>
                <td width="15%"></td>
                <td width="17%">Total</td>
                <td width="17%"  style="background-color:#999999" border="1"> PHP '.number_format($purchase->total,2).'</td>
            </tr>
        </table>

        <br><br><br>

        <table align="center">
            <tr>
                <td>
                Tel: (02)275-5225 Cellphone: 09426539472/09951218617 Website: www.thinkwoli.com.ph								
                </td>
            </tr>
        </table>

        <br><br>

        <table align="center">
            <tr>
                <td>'.$purchase->date2.'</td>
                <td></td>
                <td>'.$purchase->employee2.'</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #000;">Date</td>
                <td></td>
                <td style="border-top: 1px solid #000;></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #000;"></td>
                <td></td>
                <td style="border-top: 1px solid #000;>Authorized Signature</td>
            </tr>
        </table>
        
        ';
        return $text;
    }


}

<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Sales_invoice_library
{

    public $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->model('invoices_model');
        $this->CI->load->model('suppliers_model');
        $this->CI->load->model('customers_model');
        $this->CI->load->model('businesses_model');
    }

    public function get_sold_to($id_customer_type,$id_customer){
        if($id_customer_type == 3){ //CUSTOMERS
           return $sold_to = $this->CI->customers_model->get($id_customer)->row();
        }
        if($id_customer_type == 5){ //BUSINESS
            return $sold_to = $this->CI->businesses_model->get($id_customer)->row();
         }
    }

    public function pdf_po($id_invoice){
        $invoice = $this->CI->invoices_model->get($id_invoice)->row();

        if($invoice->id_customer_type == 3){ //CUSTOMERS
            $sold_to = $this->CI->customers_model->get($invoice->id_customer)->row();
            $name = $sold_to->name;
            $address = $sold_to->address;
            $tin = 'N/A';
        }else{ //BUSINESS
            $sold_to = $this->CI->businesses_model->get($invoice->id_customer)->row();
            $name = $sold_to->business_name;
            $address = $sold_to->bs_address;
            $tin = $sold_to->bs_tin;
        }

        $invoice_details = $this->CI->invoices_model->get_invoice_details($id_invoice)->result();
        $si_details = '';

        foreach($invoice_details as $row){
            $si_details .= '
                <tr>
                    <td  border="1">'.$row->qty.'</td>
                    <td  border="1">'.$row->unit.'</td>
                    <td  border="1">'.$row->product_name.'('.$row->brand.')</td>
                    <td  border="1">'.number_format($row->unit_price,2).'</td>
                    <td  border="1">'.number_format($row->total,2).'</td>
                </tr>
            '; 
        }


        $text = ' 
        <table style="width:100%;">
            <tr>
                <td width="60%" rowspan="6"><img src="public/assets/img/logo.png" style="width:300px"></td>
                <td width="40%" style="vertical-align: middle;"><h1><b>SALES INVOICE</b></h1></td>
            </tr>
            <tr>
                <td style="font-size:10px">3rd flr. Wichita Land Bldg. 61</td>
            </tr>
            <tr>
                <td style="font-size:10px">Visayas Avenue Project 6, Brgy. Vasra,</td>
            </tr>
            <tr>
                <td style="font-size:10px">Quezon City 1128</td>
            </tr>
            <tr>
                <td style="font-size:10px">Tel. 275-5225/ 09426539472/ 09951218617</td>
            </tr>
            <tr>
                <td style="font-size:10px">VAT REG. TIN 008-995-410-000</td>
            </tr>
        </table>

        <br><br>

        <table>
            <tr>
                <td style="font-size:10px;">
                    <b>SOLD TO:</b>	'.$name.'<br>	
                    <b>ADDRESS:</b>	'.$address.'<br>			
                    <b>TIN:</b> '.$tin.'<br>		
                </td> 

                <td style="font-size:9px;">
                </td> 

                <td style="font-size:10px;">	
                    <b>INV. No.:</b> <span style="color:red">'.$invoice->inv_nos.'</span> <br>	
                    <b>DATE:</b>  '.$invoice->date.'<br>		
                    <b>TERMS:</b> '.$invoice->terms.'<br>		
                    <b>P.O NO.:</b> '.$invoice->po_nos.'<br>            
                </td> 
            </tr>
        </table>

        <br><br>

        <table cellpadding="2">
            <tr>
                <td width="10%" style="background-color:#999999">QTY</td>
                <td width="10%" style="background-color:#999999">UNIT</td>
                <td width="50%" style="background-color:#999999">ARTICLES</td>
                <td width="15%" style="background-color:#999999">UNIT PRICE</td>
                <td width="15%" style="background-color:#999999">AMOUNT</td>
            </tr>
           '.$si_details.'
            <tr>
                <td  border="1"></td>
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
                <td  border="1"></td>
            </tr>
            <tr>
                <td  border="1"></td>
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
                <td  border="1"></td>
            </tr>
            <tr>
                <td  border="1"></td>
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
                <td  border="1"></td>
            </tr>
        </table>

        <br><br>

        <table align="center">
            <tr>
                <td><b>'.$invoice->employee_representative.'</b></td>
                <td></td>
                <td><b>Php '.number_format($invoice->tcp,2).'</b></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #000;">Authorized Representative</td>
                <td></td>
                <td style="border-top: 1px solid #000;></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #000;"></td>
                <td></td>
                <td style="border-top: 1px solid #000;>Please Pay This Amount</td>
            </tr>
        </table>
        
        ';
        return $text;
    }


}

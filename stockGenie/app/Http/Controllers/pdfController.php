<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pdfController extends Controller
{
    public function downloadInvoice($id) {
        return $id;
    }
}

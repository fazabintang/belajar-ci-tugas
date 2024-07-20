<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use Dompdf\Dompdf;

class AdmTransController extends BaseController
{
    protected $transaction;

    function __construct()
    {
        $this->transaction = new TransactionModel();
    }

    public function index()
    {
        $transaction = $this->transaction->findAll();
        $data['transaction'] = $transaction;

        return view('v_transaksi', $data);
    }

    public function edit($id)
    {
        $dataTransaksi = $this->transaction->find($id);

        $rules = [
            'status' => 'required|numeric|exact_length[1]'  // Pastikan hanya satu digit 0 atau 1
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('failed', $this->validator->listErrors());
        }

        $dataForm = [];
            if ($this->request->getPost('status') !== null) {
                $dataForm['status'] = $this->request->getPost('status');
        }
        $dataForm['updated_at'] = date("Y-m-d H:i:s");

        $this->transaction->update($id, $dataForm);

        return redirect('transaksi')->with('success', 'Status Berhasil Diubah');
    }

    public function download()
    {
        $transaction = $this->transaction->findAll();

        $html = view('v_transaksiPDF', ['transaksi' => $transaction]);

        $filename = date('y-m-d-H-i-s') . '-transaksi';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml($html);

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }
  
}
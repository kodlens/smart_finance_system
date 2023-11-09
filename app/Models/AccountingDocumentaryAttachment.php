<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingDocumentaryAttachment extends Model
{
    use HasFactory;


    protected $table = 'acctg_documentary_attachments';
    protected $primaryKey = 'acctg_doc_attachment_id';


    protected $fillable = [
        'accounting_id',
        'documentary_attachment_id',
        'documentary_attachment',
        'doc_attachment'
    ];


    public function documentary_attachment(){
        return $this->hasOne(DocumentaryAttachment::class, 'documentary_attachment_id', 'documentary_attachment_id');
    }

    
    public function acctg_documentary_attachments(){
        return $this->belongsTo(Accounting::class, 'accounting_id', 'accounting_id');
    }

}

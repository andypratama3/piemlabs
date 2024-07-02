<?php
namespace App\Actions\dashboard\Passport;

use App\Models\User;
use App\Models\Passport;
use Illuminate\Support\Str;


class PassportAction
{
    private function uploadAndRenameFile($file, $type, $name)
    {
        $ext = $file->getClientOriginalExtension();
        $upload_path = public_path("storage/images/piem_travel/{$type}/");

        // Generate unique file name using current date and time
        $current_timestamp = date('YmdHis');
        $picture_name = "{$type}_{$name}_{$current_timestamp}.{$ext}";

        // Move the uploaded file to the upload path with the new name
        $file->move($upload_path, $picture_name);

        // Return the full path to the uploaded file
        return "storage/images/piem_travel/{$type}/{$picture_name}";
    }


    private function retrieveExistingFile($slug, $type)
    {
        $passport = Passport::where('slug', $slug)->first();
    }
    public function execute($passportData)
    {

        $user = User::where('id', $passportData->user_id)->first();

        $picture_name_ktp = $passportData->ktp
            ? $this->uploadAndRenameFile($passportData->ktp, 'ktp', $user->name)
            : $this->retrieveExistingFile($passportData->slug, 'ktp');

        $picture_name_kk = $passportData->kk
            ? $this->uploadAndRenameFile($passportData->kk, 'kk', $user->name)
            : $this->retrieveExistingFile($passportData->slug, 'kk');

        $picture_name_akta_kelahiran = $passportData->akta_kelahiran
            ? $this->uploadAndRenameFile($passportData->akta_kelahiran, 'akta_kelahiran', $user->name)
            : $this->retrieveExistingFile($passportData->slug, 'akta_kelahiran');

        $picture_name_ijazah = $passportData->ijazah
            ? $this->uploadAndRenameFile($passportData->ijazah, 'ijazah', $user->name)
            : $this->retrieveExistingFile($passportData->slug, 'ijazah');

        $picture_name_surat_kawin = $passportData->surat_kawin
            ? $this->uploadAndRenameFile($passportData->surat_kawin, 'surat_kawin', $user->name)
            : $this->retrieveExistingFile($passportData->slug, 'surat_kawin');

        $picture_name_passport = $passportData->passport
            ? $this->uploadAndRenameFile($passportData->passport, 'passport', $user->name)
            : $this->retrieveExistingFile($passportData->slug, 'passport');


        $passport = Passport::updateOrCreate(
            ['slug' => $passportData->slug],
            [
                'user_id' => $passportData->user_id,
                'produk_id' => $passportData->produk_id,
                'ktp' => $picture_name_ktp,
                'kk' => $picture_name_kk,
                'akta_kelahiran' => $picture_name_akta_kelahiran,
                'ijazah' => $picture_name_ijazah,
                'surat_kawin' => $picture_name_surat_kawin,
                'passport' => $passportData->passport,
                'status' => $passportData->status,
            ]
        );


        return $passport;
    }
}

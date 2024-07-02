<?php

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Http\Requests\dashboard\Passport\PassportRequest;

class PassportData extends Data
{
    public function __construct(
        public readonly string $user_id,
        public readonly string $produk_id,
        public readonly ?UploadedFile $ktp,
        public readonly ?UploadedFile $kk,
        public readonly ?UploadedFile $akta_kelahiran,
        public readonly ?UploadedFile $ijazah,
        public readonly ?UploadedFile $surat_kawin,
        public readonly ?UploadedFile $passport,
        public readonly ?string $status,
        public readonly ?string $slug,

    ) {
        //
    }

    public static function fromRequest(PassportRequest $request): self
    {
        return self::from([
            $request->getUserId(),
            $request->getProdukId(),
            $request->getKtp(),
            $request->getKk(),
            $request->getAktaKelahiran(),
            $request->getIjazah(),
            $request->getSuratKawin(),
            $request->getPassport(),
            $request->getStatus(),
            $request->getSlug(),
        ]);
    }

    public static function messages()
    {
        return [
            'user_id.required' => 'Kolum User Tidak Boleh Kosong!',
            'produk_id.required' => 'Kolum Produk Tidak Boleh Kosong!',
            'ktp.mimesjpeg,bmp,png,gif,svg,pdf,' => 'Kolum KTP Tidak Boleh Kosong!',
            'kk.mimesjpeg,bmp,png,gif,svg,pdf,' => 'Kolum Kk Tidak Boleh Kosong!',
            'akta_kelahiran.mimesjpeg,bmp,png,gif,svg,pdf,' => 'Kolum Akta Kelahiran Tidak Boleh Kosong!',
            'ijazah.mimesjpeg,bmp,png,gif,svg,pdf,' => 'Kolum Ijazah Tidak Boleh Kosong!',
            'surat_kawin.mimesjpeg,bmp,png,gif,svg,pdf,' => 'Kolum Surat Kawin Tidak Boleh Kosong!',
            'passport.mimesjpeg,bmp,png,gif,svg,pdf,' => 'Kolum Passport Tidak Boleh Kosong!',
        ];
    }
}

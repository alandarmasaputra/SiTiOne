<?php

use Illuminate\Database\Seeder;
use App\User;
use App\ProfileContent;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	
	private function seedProfileContent(){
		$section_top = '<p><span style="font-size: 24px;"><b>Jam Pelayanan</b></span></p><p><span style="font-size: 20px;">Hari: Senin - Jumat</span></p><p><span style="font-size: 20px;">Jam: 07.30 – 15.00 WIB</span></p>';
		$section_middle = '<p><b><span style="font-size: 24px;">Visi dan Misi</span></b></p><p><b>A. Visi-Misi</b></p><p><b><br></b>VISI :</p><div>
</div><div style="margin-left: 25px;">Menjadi unit pelaksana teknis pelayanan bidang kemahasiswaan dan alumni yang professional, gunamendukungmewujudkan visi misi UKDW Menjadi Universitas Kristen unggul dan terpercaya yang melahirkan generasi profesional mandiri bagi dunia pluralistik berdasarkan kasih.</div><div style="margin-left: 25px;"><br></div><div style="margin-left: 25px;">
</div><div style="margin-left: 25px;">
</div><div>MISI :
</div><div>
</div><ol><li>Melayanihak-hak dan kepentingan mahasiswa dan alumni secara holistik, adil bermartabat dan transparans.
</li><li>Mengagregasi dan mengkomunikasikan antara kepentingan Universitas, mahasiswa dan alumni maupun mitra kerja di luar lingkup UKDW, terutama dalam bidang riset, beasiswa dan jejaring kerjasama
</li><li>Melaksanakan pendampingan program kegiatan kemahasiswaan dan alumni guna mengimplementasikan Tri Darma Perguruan Tinggi.</li></ol><p><br></p><p><b>B. Target Tujuan.</b></p><p><br></p><ol><li>Membentuk akademisi Kristen yang beriman takut akan Tuhan, pemimpin berkarakter unggul , tangguh cakap, percaya diri dan berdayaguna untuk perubahan. 
</li><li>Peningkatan kualitas dan profesionalitas pelayanan (operator) administrasi  kemahasiswaan, alumni dan kerja sama.
</li><li>Memberikan peningkatan fasilitas dan peran edukasi pelaksanaan administrasi kemahasiswaan yang meliputi bidang minat, penalaran, dan informasi kemahasiswaan, serta layanan kesejahteraan mahasiswa dalam rangka menunjang aktivitas mahasiswa terhadap kegiatan ekstrakurikuler  sebagai penunjang pembentukan karakter, kemandirian  mahasiswa.
</li><li>Peningkatan kualitas dan profesionalitas layanan sistem informasi yang mencakup pengumpulan, pengolahan, dan penyajian data serta layanan informasi dalam rangka pengembangan karir mahasiwa dan alumni.
</li></ol><p>
</p><p><b>C.    Tugas Pokok
</b></p><p><b><br></b></p><ol><li>Menyusun Rencana dan Program kerja BiroIII sebagai pedoman pelaksanaan tugas, dengan agenda pokok :<br>a.    Berkoordinasi dengan BEMU dan Pengurus Organisasi Kemahasiswaan,  melakukan konsolidasi rencana kegiatan wajib tahunan  rutin dan non rutin serta alokasi anggaran.<br>b.    Formulasi Penyusunan (seleksi) Proposal Program kegiatan kemahasiswaan dan alumni,  diajukan ke Rektor Melalui Wakil Rektor  III, meliputi bidang program pengembangan dan apresiasi Seni-budaya, olahraga, hoby, pameran  usaha-enterpreneurship, lomba inovasi dan ketrampilan mahasiswa, dan kegiatan-kegiatan lain berdasar minat dan bakat mahasiswa.</li><li>Memberi arahan kepada seluruh staff dan sub bagian di lingkungan Biro III tentang tatacara pelayanan, prosedur dan sistematika kerja guna kelancaran pelaksanaan tugas.</li><li>Membagi tugas kepada staff dan sub bagian di lingkungan Biro III sesuai dengan tugas pokok fungsi dan kemampuan SDM. 
</li><li>Mengkoordinasikan seluruh staff dan sub bagian di lingkungan Biro III dalam melaksanakan tugas agar terjalin kerjasamayang sinergi. 
</li><li>Menyelia / mencermati pelaksanaan tugas staff dan sub bagian Biro III agar hasil yang dicapai sesuai dengan sasaran yang telah ditetapkan.
</li><li>Merumuskan saran alternatif di bidang administrasi kemahasiswaan dan alumni,  dankerjasama berdasarkan masukan dari staff dan sub bagian sebagai bahan penyusunan kebijaksanaan.
</li><li>Menilai prestasi kerja  staff dan Sub Bagian  untuk bahan pembinaan dan pengembangan karier.
</li><li>Menindaklanjuti naskah kerjasama dengan instansi pemerintah dan swasta, atau perguruan tinggi lain dan lembaga gereja  sebagai bahan pengembangan jejaring beasiswa dan  kerjasama.
</li><li>Menelaah  peraturan perundang-undangan di bidang akademik, mencermati perkembangan dan aktivitas kemahasiwaan antar perguruan tinggi, sebagai bahan masukan kepada pimpinan.
</li><li>Melaksanakan pengumuman, penawaran dan seleksi calon penerima beasiswa berdasarkan ketentuan yang berlaku.
</li><li>Menyusun laporan Biro III sesuai dengan hasil yang dicapai sebagai pertanggung jawaban pelaksanaan tugas, bertanggungjawab kepada Wakil Rektor III
</li><li>Melaksanakan tugas lain yang diberikan atasan, sepanjang berlandasrkan visi misi Duta Wacana dan tata peraturan yang berlaku.</li></ol><p><br></p><p></p>';
		$section_side = '<p><span style="line-height: 24px; font-size: 24px;"><b>Tentang Biro Kemahasiswaan</b></span></p><p><span style="line-height: 24px;"><br></span></p><p><span style="line-height: 24px;">Biro III atau dapat juga disebut sebagai Biro Kemahasiswaan dan Alumnimerupakan biro yang pendiriaannya berdasarkan statuta UKDW tahun 1987 â€“ 1992, Bab 1 pasal 7 ayat 2, yaitu pembentukan sejumlah biro yang terdiri atas Biro Akademik (Biro 1), Biro Keuangan (Biro 2), dan Biro Kemahasiswaan dan Alumni (Biro 3).
</span></p><p><span style="line-height: 24px;">
</span></p><p><span style="line-height: 24px;">Biro III Bidang kemahasiswaan dan alumni adalah unit kerja yangmenangani seluruh dinamika problematik  kemahasiswaan dan alumni, kerjasama dan beasiswa sekaligus pelaksanaadministrasi ekstrakulikuler mahasiswa dan alumni yang bertanggung jawab pada Pimpinan UKDW dalam hal ini Wakil Rektor III.  Pada saat yang sama BKA (Biro Kemahasiswaan dan Alumni) bertanggung jawab untuk ikut terlibat aktif mengarahkan pentingnya mendasari mahasiswa tentang nilai-nilai moralitas dan intelektualitas yang menjunjung tinggi iman Kristen serta membentuk karakter mahasiswa yang berkepribadian mantap, berwawasan kebangsaan yang tangguh, mempunyai  pemahaman kebudayaan yang matang, dan berjiwakepemimpinan penuh kasih, mempunyai cakrawala pemikiran progresif-inovatif-inspiratif, disamping memiliki  sikap juang dan militansi yang tidak mudah menyerah dalam menghadapi masalah. 
</span></p><p><span style="line-height: 24px;">
</span></p><p><spanstyle="line-height: 24px;"="">Pembentukan karakter mahasiswa dan alumni ini akan menginternalisasi dan menjadi episentrum berbagai program kegiatan, muara akhir yang didapat adalah terciptanya lulusan profesional mandiri yang tanggap tanggon tangguh dalam masyarakat, dan alumni yang mampu memenangkan kompetisi dalam dunia kerja serta alumni yang berperan besar dalam ikut serta menentukan arah masa depan bangsa. Bentuk-bentuk program pembentukan karakter ini dapat ditempuh melalui berbagai pelatihan yang penyelenggaraannya dilakukan kerja sama dengan pihak ke III (sponsor)
</spanstyle="line-height:></p><p><span style="line-height: 24px;">
</span></p><p><span style="line-height: 24px;">Komunikasi dan konsolidasi yang intens dengan alumni menjadi program kerja prioritas berikutnya, dimana alumni Duta Wacana harus ditempatkan sebagai mitra perjuangan untuk secara bersama-sama terus mengibarkan Panji Duta Wacana : Palang danLilin yang menyala. Mendukung kembali Duta Wacana sebagai almamater harus ditanamkan sebagai bentuk kasih danrasa syukur pemeliharaan Duta Wacana sebagai ladang Tuhan. Membekali pengetahuan praktis  Survival of life dalam etos kehidupan luas, akan berguna untuk memenangkan pertarungan di berbagai medan kompetisi, baik di dunia kerja, ekonomi kewirausahaan, politik, budaya, namun sekaligus mampu menempatkan diri sebagai tokoh pribadi yang memotori toleransi kehidupan pluralistic : makhluk sosial-beragama.</span></p><p><span style="line-height: 24px;">
</span></p><p><span style="line-height: 24px;">Pengelolaan dan pengembangan Bidang kerjasama dan beasiswa merupakan tugas penting, bukan saja hanya sekedar menyalurkan-mengurus administrasi program beasiswa yang sudah ada, namun harus berupaya menambah kuantitas, kualitas dan jejaring kerjasama pemberi beasiswa, dalam kerangka memberikan kesejahteraan kepada Mahasiswa. Dalam bidang ini Biro III perlu secara intens menjalin kerjasama dengan berbagai lembaga/ gereja / perusahaan untuk secara bersama-sama merancang program beasiswa secara holistic, sehingga output penerima mahasiswa berpengaruh terhadap agent of change maupun income yang positif bagi hubungan simbiose mutualisme antara stake holders. 
</span></p><p><span style="line-height: 24px;">
</span></p><p><span style="line-height: 24px;">Pelayanan yang baik danterpadu,  pendataan dan sistem administrasi yang rapi, sistem alur birokrasi yang ramah, informative, pelayanan yang mudah dan cepat bagi mahasiswa dan alumni serta mitra kerja Biro III akan membantu meningkatnya pencitraan terhadap DutaWacana secara utuh. Oleh karenanya struktur, sistematika kerja  dan pembagian tugas harus jelas dan dilaksanakan secara disiplin, dedikasi dan penuh tanggungjawab disertai harapan dan pemahaman spiritualitas, bahwa semua pekerjaan yang dilakukan adalah untuk kemuliaan Kerajaan Allah.&nbsp;</span></p>';
		$this->saveProfileSection("section-side",$section_side);
		$this->saveProfileSection("section-middle",$section_middle);
		$this->saveProfileSection("section-top",$section_top);
		
	}
	
	private function saveProfileSection($section_name, $contents){
		for( $i = 0; $i <= strlen($contents); $i+=255 ) {
			$content = substr( $contents, $i, 255);
			$newProfileContent = new ProfileContent();
			$newProfileContent->section_name = $section_name;
			$newProfileContent->content = $content;
			$ret[] = $content;
			if($newProfileContent->content){
				$newProfileContent->save();
			}
		}
	}
	
    public function run()
    {
		$admin = new User;
		$admin->email = "superadmin@gmail.com";
		$admin->username = "admin";
		$admin->password = bcrypt('admin');
		$admin->auth_level = 0;
		$admin->is_aktif = true;
		$admin->save();
        // $this->call(UsersTableSeeder::class);

        $admins = new User;
        $admins->email = "asdad@yahoo.com";
        $admins->username = "admins";
        $admins->password = bcrypt('admins');
        $admins->auth_level = 2;
        $admins->is_aktif = true;
        $admins->save();
		
		$this->seedProfileContent();
    }
}

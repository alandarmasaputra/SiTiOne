@section('head_title')
Biro3 | UKDW
@endsection

@section('nav_profil')
active
@endsection

@extends('layout.app')
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="readmore.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
        
<style>
				img.avatar {
					border: 3px solid #e1e1e1;
					height: 100px;
					width: 100px;
					margin: auto;
				}

				.only-bottom-margin {
				  margin-top: 3%;
				}

				.activity-mini {
				  padding-right: 0px;
				  float: left;
				}
				.img-circle {
					-webkit-animation: fadein 2.5s; /* Safari and Chrome */
					-moz-animation: fadein 2.5s; /* Firefox */
					-ms-animation: fadein 2.5s; /* Internet Explorer */
					-o-animation: fadein 2.5s; /* Opera */
					animation: fadein 2.5s;
				}

				@keyframes fadein {
					from { opacity: 0; }
					to   { opacity: 1; }
				}

				/* Firefox */
				@-moz-keyframes fadein {
					from { opacity: 0; }
					to   { opacity: 1; }
				}

				/* Safari and Chrome */
				@-webkit-keyframes fadein {
					from { opacity: 0; }
					to   { opacity: 1; }
				}

				/* Internet Explorer */
				@-ms-keyframes fadein {
					from { opacity: 0; }
					to   { opacity: 1; }
				}​

				/* Opera */
				@-o-keyframes fadein {
					from { opacity: 0; }
					to   { opacity: 1; }
				}​


</style>
@section('body_content')
  <section id="blog" class="container">
        <div class="blog">
            <div class="row">	
				<div class="col-md-2 text-center avatars">
					<div class="row">
						<a href="" data-toggle="modal" data-target=".bs-example-modal-lg"><img class="img-circle avatar avatar-original" src="{{url('/style/images/download.png')}}"></a>
						<div><h4 class="only-bottom-margin">Crisna Julius</h4></div>
					</div>
							<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  								<div class="modal-dialog modal-lg">
										
												<h2>Crisna Julius</h2>
												<img class="img-circle avatar avatar-original" src="{{url('/style/images/download.png')}}">
												<h4>Jabatan	:	Kepala Unit</h4>
												<h4>Email	:	crisna@staff.ukdw.ac.id</h4>
												<h4>Phone	:	085850000807</h4>	
												<h3>                             </h3>
    									
										<div class="modal-footer">
        										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      									</div>
								</div>
							</div>
					<div class="row">
						<a href="" data-toggle="modal" data-target=".bs-example-modal"><img class="img-circle avatar avatar-original" src="{{url('/style/images/sutapa.jpg')}}"></a>
						<div>
							<h4 class="only-bottom-margin">Sutopo Atmojo</h4>
						</div>
					</div>
							<div class="modal fade bs-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  								<div class="modal-dialog modal-lg">
										
												<h2>Sutopo Atmojo</h2>
												<img class="img-circle avatar avatar-original"  src="{{url('/style/images/sutapa.jpg')}}" >
												<h4>Jabatan	:	Staff Unit</h4>
												<h4>Email	:	topo@staff.ukdw.ac.id</h4>
												<h4>Phone	:	- </h4>
												<h3>                             </h3>
    									
										<div class="modal-footer">
        										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      									</div>
								</div>
							</div>
					<!--kurang Bp. Handono-->
						
					</div>
				
                 <div class="col-md-7">
                    <div class="blog-item">
                        <div class="row">  
                            <div class="col-xs-12 col-sm-10 blog-content">
                                <h8>Jam Pelayanan : Senin - Jum'at </h8><br>
                                	<h8>Jam : 07.30 – 15.00 WIB</h8>
								  <div class="col-sm-10 blog-content">
									 
									  <div class="accordion-group">
    								<!--<div class="accordion-heading">
      									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion5" href="#collapseFive">-->
      									
											<h2>A. VISI-MISI</h2>
										
    								</div>
								<!--<div id="collapseFive" class="accordion-body collapse">-->
      							<div class="accordion-inner">
										<h4>VISI :</h4>
											<p>Menjadi unit pelaksana teknis pelayanan bidang kemahasiswaan dan alumni yang professional, guna mendukung mewujudkan visi misi UKDW Menjadi Universitas Kristen unggul dan terpercaya yang melahirkan generasi profesional mandiri bagi dunia pluralistik berdasarkan kasih.</p>

 										<h4>MISI :</h4>
											<ol>
												<li>Melayani hak-hak dan kepentingan mahasiswa dan alumni secara holistik, adil bermartabat dan transparans.</li>
												<li>Mengagregasi dan mengkomunikasikan  antara kepentingan Universitas, 
												mahasiswa dan alumni maupun mitra kerja di luar lingkup UKDW, terutama dalam bidang riset, beasiswa dan jejaring kerjasama</li>
												<li>Melaksanakan pendampingan program kegiatan kemahasiswaan dan alumni guna 
												mengimplementasikan Tri Darma Perguruan Tinggi.</li>
											</ol>
										<!--<button class="SeeMore2" data-toggle="collapse" href="#collapseFive">See Less</button>
										<div>
									       <h2>      </h2>
										</div></div></div>-->
							 	</div> 
									 
								<div class="accordion-group">
    							<!--	<div class="accordion-heading">
      									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne">-->
									  
											<h2>B. Target Tujuan</h2>
										
    								</div>
								<!--<div id="collapseOne" class="accordion-body collapse">-->
      							<div class="accordion-inner">
										<ol>
											<li>Membentuk akademisi Kristen yang beriman takut akan Tuhan, pemimpin berkarakter unggul , tangguh cakap, percaya diri dan berdayaguna untuk perubahan.</li>
											<li>Peningkatan kualitas dan profesionalitas pelayanan (operator) administrasi  kemahasiswaan, alumni dan kerja sama.</li>
											<li>Memberikan peningkatan fasilitas dan peran edukasi pelaksanaan administrasi kemahasiswaan yang meliputi bidang minat, penalaran, dan informasi kemahasiswaan, serta layanan kesejahteraan mahasiswa dalam rangka menunjang aktivitas mahasiswa terhadap kegiatan ekstrakurikuler  sebagai penunjang pembentukan karakter, kemandirian  mahasiswa.</li>
											<li>Peningkatan kualitas dan profesionalitas layanan sistem informasi yang mencakup pengumpulan, pengolahan, dan penyajian data serta layanan informasi dalam rangka pengembangan karir mahasiwa dan alumni.
											</li>
										</ol>
										<!--<button class="SeeMore2" data-toggle="collapse" href="#collapseOne">See Less</button>
										<div>
									       <h2>      </h2>
										</div>
									</div>
							 	</div>--> 
							</div>	
							
									  <div class="accordion-group">
    							<!--	<div class="accordion-heading">
      									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapseThree">-->
										 
											<h2>C. Tugas Pokok</h2>
										
    								</div>
								<!--<div id="collapseThree" class="accordion-body collapse">-->
      							<div class="accordion-inner">
										<ol>
											<li>Menyusun Rencana dan Program kerja Biro III sebagai pedoman pelaksanaan tugas, dengan agenda pokok :</li>
								   		<ul>
											<li>Berkoordinasi dengan BEMU dan Pengurus Organisasi Kemahasiswaan,  melakukan konsolidasi rencana kegiatan wajib tahunan  rutin dan non rutin serta alokasi anggaran.</li>
									   		<li>Formulasi Penyusunan (seleksi) Proposal Program kegiatan kemahasiswaan dan alumni,  diajukan ke Rektor Melalui Wakil Rektor  III, meliputi bidang program pengembangan dan apresiasi Seni-budaya, olahraga, hoby, pameran  usaha-enterpreneurship, lomba inovasi dan ketrampilan mahasiswa, dan kegiatan-kegiatan lain berdasar minat dan bakat mahasiswa.</li>
								   		</ul>
								   			<li>Memberi arahan kepada seluruh staff dan sub bagian di lingkungan Biro III tentang tatacara pelayanan, prosedur dan sistematika kerja guna kelancaran pelaksanaan tugas.</li>
								   			<li>Membagi tugas kepada staff dan sub bagian di lingkungan Biro III sesuai dengan tugas pokok fungsi dan kemampuan SDM. </li>
								   			<li>Mengkoordinasikan seluruh staff dan sub bagian di lingkungan Biro III dalam melaksanakan tugas agar terjalin kerjasama yang sinergi.</li>
								   			<li>Menyelia / mencermati pelaksanaan tugas staff dan sub bagian Biro III agar hasil yang dicapai sesuai dengan sasaran yang telah ditetapkan.</li>
											<li>Merumuskan saran alternatif di bidang administrasi kemahasiswaan dan alumni,  dan  kerjasama berdasarkan masukan dari staff dan sub bagian sebagai bahan penyusunan kebijaksanaan.</li>
											<li>Menilai prestasi kerja  staff dan Sub Bagian  untuk bahan pembinaan dan pengembangan karier.</li>
								   			<li>Menindaklanjuti naskah kerjasama dengan instansi pemerintah dan swasta, atau perguruan tinggi lain dan lembaga gereja  sebagai bahan pengembangan jejaring beasiswa dan  kerjasama.</li>
								   			<li>Menelaah  peraturan perundang-undangan di bidang akademik, mencermati perkembangan dan aktivitas kemahasiwaan antar perguruan tinggi, sebagai bahan masukan kepada pimpinan.</li>
								   			<li>Melaksanakan pengumuman, penawaran dan seleksi calon penerima beasiswa berdasarkan ketentuan yang berlaku.</li>
								   			<li>Menyusun laporan Biro III sesuai dengan hasil yang dicapai sebagai pertanggung jawaban pelaksanaan tugas, bertanggungjawab kepada Wakil Rektor III</li>
								   			<li>Melaksanakan tugas lain yang diberikan atasan, sepanjang berlandasrkan visi misi Duta Wacana dan tata peraturan yang berlaku.</li>
						    			</ol> 
										<!--<button class="SeeMore2" data-toggle="collapse" href="#collapseThree">See Less</button>
										<div>
									       <h2>      </h2>
										</div>
									</div>
							 	</div> -->
							</div>
								
								<!--<div class="accordion-group">-->
    								<div class="accordion-group">
      								<!--<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#collapseFour">-->
									 
											<h2>D. Layanan Unit</h2>
									 
    								</div>
									<!--<div id="collapseFour" class="accordion-body collapse">-->
      								<div class="accordion-inner">
										<ol>
											<li>Bidang Pengembangan Kemahasiswaan:</li>
											<ul>
													<li>Merencanakan dan menyelenggarakan program dan kegiatan peningkatan penalaran, pelatihan kepemimpinan, pendidikan karakter, pembinaan minat dan bakat kemahasiswaan</li>
													<li>Pemantau kegiatan rutin-wajib mahasiswa (OKA, P3DM, P2KM, LKMM) dan non rutin tidak wajib (Kewirausahaan, P2SM, P2KI) serta pendistribusian sertifikatnya</li>
													<li>Menerbitkan surat ijin/rekomendasi kegiatan kemahasiswaan; Memproses pemilihan mahasiswa berprestasi</li>
													<li>Melaksanakan urusan pemilihan mahasiswa berprestasi/program keteladanan</li>
													<li>Pengelola jas almamater (pembuatan dan pendistribusian ke mahasiswa)</li>
													<li>Pembuat surat keterangan jumlah point keaktifan sebagai syarat mendaftar wisuda</li>
													<li>Melaksanakan wisuda, mengelola toga wisuda (pembuatan, penjualan, peminjaman, pengembalian, dan perawatan)</li>
												</ul>
										<li>Bidang Beasiswa,  Kesejahteraan, Konseling dan Advokasi Mahasiswa :</li>
												<ul>
													<li>Mengelola pengembangan beasiswa, kerjasama  dan fasilitas kesejahteraan mahasiswa</li>
													<li>Melaksanakan advokasi hukum kepada mahasiswa dalam hubungan dengan kegiatan dengan mahasiswa</li>
													<li>Melayani konsultasi personal dan menjadi mediator berkaitan dengan masalah-masalah yang berkaitan dengan Proses perkuliahan</li>
													<li>Pengelola pinjaman sementara registrasi dan Pengelola data mahasiswa penerima pinjaman khusus</li>
													<li>Distribusi volunteer mahasiswa penerima beasiswa ke unit-unit / Lembaga di UKDW dan luar UKDW</li>
													<li>Pemagangan ke berbagai perusahaan sebagai bentuk perintisan karir mahasiswa</li>
													<li>Melakukan pendampingan dan menerbitkan surat pengantar ke kantor imigrasi bagi mahasiswa asing</li>
													<li>Ikut memantau dan mendukung optimalisasi fungsi asrama mahasiswa</li>
												</ul>
									<li>Bidang Administrasi dan Pengembangan Karir Alumni :</li>
												<ul>
													<li>Mengkonsolidasikan dan menjadi motivator bagi alumni pada setiap periode wisuda agar dapat terbentuk kepengurusan setiap periode wisuda</li>
													<li>Mengumpulkan, menginventarisir,  mengolah menyusun,  mengupdate database dan menyajikan data kemahasiswaan dan Alumni, secara  valid dan akurat agar dapat digunakan untuk kebutuhan administrasi umum dan menangkap pasar kerja</li>
													<li>Meningkatkan konsolidasi dan komunikasi kepada anggota dalam bentuk pemberian informasi tentang beasiswa, bursa kerja bagi mahasiswa maupun calon alumni</li>
													<li> Melakukan koordinasi dengan IKADUWA, menjadi fasiltator secara lateral dan vertikal, membangun networking bagi alumni dan kelompok minat yang mempunyai kreasi, gagasan dan rencana-rencana karyanya</li>
													<li>Penerbitan kartu anggota alumni setiap periode wisuda yang dapat digunakan sebagai tanda bukti alumni , Meningkatkan dan memelihara  hubungan kerjasama dengan alumni memberikan akses dan fasilitas serta wadah berkumpulnya alumni</li>
													<li>Memberikan pelatihan kerja dan entrepreneurship (kewirausahaan) kepada alumni untuk meningkatkan daya saing alumni</li>
													<li>Menginformasikan peluang kerja bagi alumni bekerjasama dengan PPKPK, Mengadakan job fair bagi mahasiswa dan alumni</li>
													<li>Merencanakan dan menyelenggarakan temu alumni secara berkala yang tematik dan bermanfaat</li>
													<li>Mengkoordinir alumni dan mahasiswa untuk terlibat aktif dalam kerja sosial/pengabdian pada masyarakat terutama dalam tanggap darurat dan mitigasi bencana</li>
													<li>Membangun dan mengelola media komunikasi (bulletin),  official website  bagi para alumni</li>
												</ul>
											</ol>
											<!--<button class="SeeMore2" data-toggle="collapse" href="#collapseFour">See Less</button>
											<div>
									       <h2>      </h2>
										</div>
										</div>
							 		</div> -->
								</div>
                            </div>
                            </div>
							
                        </div>    
                    </div><!--/.blog-item-->
                   
                </div><!--/.col-md-8-->

                <aside class="col-md-3">
                    <div class="widget search">
                        <h3>Tentang Biro Kemahasiswaan</h3>
						 <div class="accordion-group">
    						<!--<div class="accordion-heading">
      							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">-->
									<p>  Biro III atau dapat juga disebut sebagai Biro Kemahasiswaan dan Alumni merupakan biro yang pendiriaannya berdasarkan statuta UKDW tahun 1987 – 1992, Bab 1 pasal 7 ayat 2, yaitu pembentukan sejumlah biro yang terdiri atas Biro Akademik (Biro 1), Biro Keuangan (Biro 2), dan Biro Kemahasiswaan dan Alumni (Biro 3).</p>
								<!--</a>
    						</div>
							<div id="collapseTwo" class="accordion-body collapse">
      							<div class="accordion-inner">-->
										<p>  Biro III Bidang kemahasiswaan dan alumni adalah unit kerjayang menangani seluruh dinamika problematik  kemahasiswaan dan alumni, kerjasama dan beasiswa sekaligus pelaksana administrasi ekstrakulikuler mahasiswa dan alumni yang bertanggung jawab pada Pimpinan UKDW dalam hal ini Wakil Rektor III.  Pada saat yang sama BKA (Biro Kemahasiswaan dan Alumni) bertanggung jawab untuk ikut terlibat aktif mengarahkan pentingnya mendasari mahasiswa tentang nilai-nilai moralitas dan intelektualitas yang menjunjung tinggi iman Kristen serta membentuk karakter mahasiswa yang berkepribadian mantap, berwawasan kebangsaan yang tangguh, mempunyai  pemahaman kebudayaan yang matang, dan berjiwa kepemimpinan penuh kasih, mempunyai cakrawala pemikiran progresif-inovatif-inspiratif, disamping memiliki  sikap juang dan militansi yang tidak mudah menyerah dalam menghadapi masalah.</p> 
								
										<p> Pembentukan karakter mahasiswa dan alumni ini akan menginternalisasi dan menjadi
										episentrum berbagai program kegiatan, muara akhir yang didapat adalah terciptanya lulusan profesional mandiri yang tanggap tanggon tangguh dalam masyarakat, dan alumni yang mampu memenangkan kompetisi dalam dunia kerja serta alumni yang berperan besar dalam ikut serta menentukan arah masa depan bangsa. Bentuk-bentuk program pembentukan karakter ini dapat ditempuh melalui berbagai pelatihan yang penyelenggaraannya dilakukan kerja sama dengan pihak ke III (sponsor)</p>

										<p>	Komunikasi dan konsolidasi yang intens dengan alumni menjadi program kerja prioritas
										berikutnya, dimana alumni Duta Wacana harus ditempatkan sebagai mitra perjuangan untuk secara bersama-sama terus mengibarkan Panji Duta Wacana : Palang dan Lilin yang menyala. Mendukung kembali Duta Wacana sebagai almamater harus ditanamkan sebagai bentuk kasih dan rasa syukur pemeliharaan Duta Wacana sebagai ladang Tuhan. Membekali pengetahuan praktis  Survival of life dalam etos kehidupan luas, akan berguna untuk memenangkan pertarungan di berbagai medan kompetisi, baik di dunia kerja, ekonomi kewirausahaan, politik, budaya, namun sekaligus mampu menempatkan diri sebagai tokoh pribadi yang memotori toleransi kehidupan pluralistic : makhluk sosial-beragama.</p>

										<p>  Pengelolaan dan pengembangan Bidang kerjasama dan beasiswa merupakan tugas penting, bukansaja hanya sekedar menyalurkan-mengurus administrasi program beasiswa yang sudah ada, namun harus berupaya menambah kuantitas, kualitas dan jejaring kerjasama pemberi beasiswa, dalam kerangka memberikan kesejahteraan kepada Mahasiswa. Dalam bidang ini Biro III perlu secara intens menjalin kerjasama dengan berbagai lembaga/ gereja / perusahaan untuk secara bersama-sama merancang program beasiswa secara holistic, sehingga output penerima mahasiswa berpengaruh terhadap agent of change maupun income yang positif bagi hubungan simbiose mutualisme antara stake holders.</p>

										<p>  Pelayanan yang baik dan terpadu,  pendataan dan sistem administrasi yang rapi, sistem
										alur birokrasi yang ramah, informative, pelayanan yang mudah dan cepat bagi mahasiswa dan alumni serta mitra kerja Biro III akan membantu meningkatnya pencitraan terhadap Duta Wacana secara utuh. Oleh karenanya struktur, sistematika kerja  dan pembagian tugas harus jelas dan dilaksanakan secara disiplin, dedikasi dan penuh tanggungjawab disertai harapan dan pemahaman spiritualitas, bahwa semua pekerjaan yang dilakukan adalah untuk kemuliaan Kerajaan Allah.</p>
								<!--		<button class="SeeMore2" data-toggle="collapse" href="#collapseTwo">See Less</button>
										<div>
									       <h2>      </h2>
										</div>
								</div>
							 </div>-->
							 
						</div>
                    </div>
    			</aside> 
				
            </div><!--/.row-->
			<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
        </div>
		
    </section><!--/#blog-->
@endsection
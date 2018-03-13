//Init
document.getElementsByTagName('span').innerHTML = '';
const request = ajax({ baseUrl: base_url });
let total = 0;

/**Inisialisasi data Kriteria */
const dataKriteria = (params) => {
	const dataKriteria = new DataTable('#table-kriteria', {
		searchable: false,
		sortable: false,
		perPage: 5,
		plugins: {
			editable: {
				enabled: true,
				contextMenu: true,
				hiddenColumns: true,
				menuItems: [
					{
						text: "<span class='mdi mdi-lead-pencil'></span> Edit",
						action: function() {
							this.editCell();
						}
					},
					{
						text: "<span class='mdi mdi-delete'></span> Remove",
						action: function() {
							if (confirm('Anda yakin ingin menghapus kriteria ini ?')) {
								NProgress.start();
								let a = document.querySelector('.abc');
								let b = a.getAttribute('data-id');
								console.log(b);
								ajax()
									.post('kriteria/delKriteria', {
										id: b
									})
									.then(function(res) {
										console.log('success');
										RatingKecocokan().reload();
										HasilPerangkingan().reload();
										HasilPerangkingan().rank();
										MatriksNormalisasi().reload();
										NProgress.done();
									})
									.catch(function(err) {
										console.log(err);
									});
								this.removeRow();
							}
						}
					}
				]
			}
		}
	});
};

/**ES6 Version */
const InitKriteria = () => {
	let barisKriteria = document.getElementsByClassName('abc');
	for (const i of barisKriteria) {
		i.onkeydown = (e) => {
			if (e.keyCode == 13) {
				let a = i.getAttribute('data-id');
				setTimeout(() => {
					let b = i.firstChild.textContent;
					let c = i.lastChild.textContent;
					NProgress.start();

					if (isNaN(c) || c < 1 || c > 10) {
						alert('Hanya bisa angka dari 1 - 10');
					} else {
						ajax()
							.post('kriteria/editKriteria', {
								id: a,
								nama: b,
								bobot: c
							})
							.then((res) => {
								RatingKecocokan().reload();
								HasilPerangkingan().reload();
								HasilPerangkingan().rank();
								MatriksNormalisasi().reload();
								NProgress.done();
							})
							.catch((err) => {
								console.log(err);
							});
					}
				}, 10);
			}
		};
	}
};

/**Inisialisai Data Guru */
const dataGuru = new DataTable('#table-guru', {
	searchable: false,
	sortable: false,
	perPage: 5,
	plugins: {
		editable: {
			enabled: true,
			contextMenu: true,
			hiddenColumns: true,
			menuItems: [
				{
					text: "<span class='mdi mdi-lead-pencil'></span> Edit",
					action: function() {
						this.editCell();
					}
				},
				{
					text: "<span class='mdi mdi-delete'></span>Remove",
					action: function(e) {
						if (confirm('Anda yakin ingin menghapus data guru ini ?')) {
							NProgress.start();
							let a = document.querySelector('.barisDataGuru');
							let b = a.getAttribute('data-id');
							ajax()
								.post('guru/deleteGuru', {
									id: b
								})
								.then(function(res) {
									RatingKecocokan().reload();
									HasilPerangkingan().reload();
									HasilPerangkingan().rank();
									MatriksNormalisasi().reload();
									NProgress.done();
									console.log('success');
								})
								.catch(function(err) {
									console.log(err);
								});
							this.removeRow();
						}
					}
				}
			]
		}
	}
});

/** ES6 Version */
const InitGuru = () => {
	let baris = document.getElementsByClassName('barisDataGuru');
	for (const i of baris) {
		i.onkeydown = (e) => {
			if (e.keyCode == 13) {
				let a = i.getAttribute('data-id');
				setTimeout(() => {
					let b = i.cells[0].textContent;
					let c = i.cells[1].textContent;
					let d = i.cells[2].textContent;
					NProgress.start();

					ajax()
						.post('guru/editGuru', {
							id: a,
							nama: b,
							jabatan: c,
							alamat: d
						})
						.then((res) => {
							MatriksNormalisasi().reload();
							RatingKecocokan().reload();
							HasilPerangkingan().reload();
							HasilPerangkingan().rank();
							NProgress.done();
							console.log('success');
						})
						.catch((err) => {
							console.log(err);
						});
				}, 10);
			}
		};
	}
};

/** Rating Kecocokan 
* 	Initialize and return function to reload from other function
* 	Tidak membutuhkan parameter apapun
**/
const RatingKecocokan = () => {
	const Init = () => {
		let kriteriaRating = document.getElementsByClassName('kriteriaRating');
		for (const i of kriteriaRating) {
			i.onkeydown = (e) => {
				if (e.keyCode == 13) {
					let guru = i.getAttribute('data-guru');
					let krit = i.getAttribute('data-krit');
					let id = i.getAttribute('data-id');
					setTimeout(() => {
						const nilai = i.textContent;
						ajax()
							.post('hasil/addRating', {
								id_guru: guru,
								id_krit: krit,
								nilai: nilai
							})
							.then((res) => {
								HasilPerangkingan().reload();
								HasilPerangkingan().rank();
								MatriksNormalisasi().reload();
							})
							.catch((err) => {
								console.log(err);
							});
					}, 10);
				}
			};
		}
	};

	const Rating = () => {
		const RatingKecocokan = new DataTable('#ThasilRatingKecocokan', {
			searchable: false,
			sortable: false,
			plugins: {
				editable: {
					enabled: true,
					contextMenu: true,
					hiddenColumns: true,
					menuItems: [
						{
							text: "<span class='mdi mdi-lead-pencil'></span> Edit",
							action: function() {
								this.editCell();
							}
						}
					]
				}
			}
		});
	};

	/** 
	 * Reload current table 
	 */
	const reload = () => {
		ajax()
			.get('hasil/ratingkecocokan')
			.then((res) => {
				document.getElementById('hasilRatingKecocokan').innerHTML = res;
				Rating();
			})
			.catch((err) => {});
	};

	Rating();
	/** Return function reload */
	return {
		reload: reload,
		init: Init
	};
};

/** 
 * Matriks Normalisasi
 */
const MatriksNormalisasi = () => {
	const Reload = () => {
		ajax()
			.get('hasil/normalisasi')
			.then((res) => {
				document.getElementById('matriksNormalisasi').innerHTML = res;
			})
			.catch((err) => {});
	};
	return {
		reload: Reload
	};
};

/**
 * Hasil Perangkingan
 * Perangkingan
 * Reload
 */
const HasilPerangkingan = () => {
	const HasilPerangkingan = (e) => {
		new DataTable('#hasilPerangkingan', {
			searchable: false,
			sortable: true,
			perPage: 5
		});
	};
	const Perangkingan = (e) => {
		ajax()
			.get('hasil/perangkingan')
			.then((res) => {
				document.getElementById('perangkingan').innerHTML = res;
			})
			.catch((err) => {});
	};
	const reload = () => {
		ajax()
			.get('hasil/hasilperangkingan')
			.then((res) => {
				document.getElementById('bHasilPerangkingan').innerHTML = res;
			})
			.catch((err) => {});
	};

	/** Initialize inner function */
	HasilPerangkingan();

	/** Return reload untuk reload agar realtime by ajax(xhr) */
	return {
		reload: reload,
		rank: Perangkingan
	};
};

/** Inisialisai Button - button */
document.addEventListener('click', function(e) {
	/**Kriteria */
	let tambahBaru = document.getElementById('tambahKriteria');
	let dKriteria = document.getElementById('daftarKriteria');
	let addKriteria = document.getElementById('addKriteria');
	let backKriteria = document.getElementById('kembaliKriteria');

	if (tambahBaru.contains(e.target)) {
		/**
		 * Membuat animasi untuk menambah kan kriteria baru
		 */
		dKriteria.classList.add('animated', 'zoomOut');
		dKriteria.style.display = 'none';
		addKriteria.style.display = 'block';
		addKriteria.classList.add('animated', 'slideInRight');
	} else if (backKriteria.contains(e.target)) {
		dKriteria.style.display = 'block';
		addKriteria.style.display = 'none';
		dKriteria.classList.remove('zoomOut');
		dKriteria.classList.add('slideInRight');
	} else if (document.getElementById('submitKriteria').contains(e.target)) {
		let nama = document.getElementById('nama');
		let nilai = document.getElementById('pilihanBobot').value;

		if (total.then > 5) {
			let node = document.createElement('span');
			let text = document.createTextNode(
				'Mohon maaf anda tidak bisa memasukkan kriteria lagi. Karena bobot kriteria sudah lebih dari 1'
			);
			node.appendChild(text);
			document.getElementById('formKriteria').appendChild(node);
			nama.value = '';
		} else {
			NProgress.start();
			ajax()
				.post('kriteria/addKriteria', {
					nama: nama.value,
					bobot: nilai
				})
				.then(function(res) {
					let table = document.getElementById('dataKriteria');
					let row = table.insertRow(0);
					let name = row.insertCell(0);
					let bobot = row.insertCell(1);

					row.classList.add('abc');
					row.setAttribute('data-id', res.id);
					name.classList.add('namaKriteria');
					name.innerHTML = res.nama;
					bobot.classList.add('bobotKriteria');
					bobot.innerHTML = res.bobot * 10;

					nama.value = '';
					NProgress.done();

					MatriksNormalisasi().reload();
					RatingKecocokan().reload();
					HasilPerangkingan().reload();
					HasilPerangkingan().rank();
					InitKriteria();
				})
				.catch((err) => {
					console.log(err);
				});
		}
	}

	/**Guru */
	let tambahGuru = document.getElementById('tambahGuru');
	let kembaliGuru = document.getElementById('kembaliGuru');
	let daftarGuru = document.getElementById('daftarGuru');
	let formAddGuru = document.getElementById('addGuru');
	let submitGuru = document.getElementById('submitGuru');

	if (tambahGuru.contains(e.target)) {
		daftarGuru.style.display = 'none';
		formAddGuru.style.display = 'block';
		formAddGuru.classList.add('animated', 'slideInLeft');
	} else if (kembaliGuru.contains(e.target)) {
		formAddGuru.style.display = 'none';
		daftarGuru.style.display = 'block';
		daftarGuru.classList.add('animated', 'slideInLeft');
	} else if (submitGuru.contains(e.target)) {
		let nama = document.getElementById('addNamaGuru');
		let jabatan = document.getElementById('addJabatanGuru');
		let alamat = document.getElementById('addAlamatGuru');
		NProgress.start();

		ajax()
			.post('guru/addGuru', {
				nama: nama.value,
				jabatan: jabatan.value,
				alamat: alamat.value
			})
			.then((res) => {
				let table = document.getElementById('dataGuru');
				let row = table.insertRow(0);
				let name = row.insertCell(0);
				let jbt = row.insertCell(1);
				let alm = row.insertCell(2);

				row.classList.add('barisDataGuru');
				row.setAttribute('data-id', res.id);
				name.classList.add('namaGuru');
				jbt.classList.add('jabatanGuru');
				alm.classList.add('alamatGuru');

				name.innerHTML = res.nama;
				jbt.innerHTML = res.jabatan;
				alm.innerHTML = res.alamat;

				nama.value = '';
				alamat.value = '';
				jabatan.value = '';

				InitGuru();
				RatingKecocokan().reload();
				HasilPerangkingan().reload();
				HasilPerangkingan().rank();
				MatriksNormalisasi().reload();
				NProgress.done();
			})
			.catch((err) => {
				console.log(err);
			});
	}
});

/** Start the function 10ms after page load */
setTimeout(() => {
	dataKriteria();
	InitKriteria();
	InitGuru();
	setTimeout(() => {
		RatingKecocokan();
		RatingKecocokan().init();
		setTimeout(() => {
			HasilPerangkingan();
		}, 250);
	}, 150);
}, 10);

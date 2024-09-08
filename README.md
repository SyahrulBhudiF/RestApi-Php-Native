# REST API KING PHP Native

**Use design pattern CSRM**
<br>Controller -> Service -> Repository -> Model -> Repository -> Service -> Controller

**Penjelasan alur:**

- Controller menerima request HTTP.
- Controller memanggil Service yang sesuai.
- Service meminta data dari Repository.
- Repository berinteraksi dengan Model dan database.
- Data dikembalikan melalui Repository ke Service.
- Service memproses data jika diperlukan.
- Controller menerima hasil dari Service dan mengirimkan response.

**Keuntungan dari pola ini:**

- Separation of Concerns yang lebih baik.
- Lebih mudah untuk unit testing.
- Lebih fleksibel untuk perubahan sumber data atau logika bisnis.
- Cocok untuk aplikasi yang kompleks atau yang memerlukan skalabilitas.

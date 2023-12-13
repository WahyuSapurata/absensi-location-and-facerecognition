# face_recognition_script.py
import sys
import cv2

def recognize_face(image_path, result_path):
    # Baca gambar
    image = cv2.imread(image_path)

    # Lakukan proses face recognition sesuai kebutuhan

    # Contoh: Ubah gambar ke skala abu-abu
    gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)

    # Simpan hasil
    cv2.imwrite(result_path, gray)

    return result_path

if __name__ == "__main__":
    # Pastikan argumen baris perintah sudah diberikan
    if len(sys.argv) != 3:
        print("Usage: python face_recognition_script.py <image_path> <result_path>")
        sys.exit(1)

    # Ambil path gambar dari argumen baris perintah
    image_path = sys.argv[1]

    # Ambil path hasil dari argumen baris perintah
    result_path = sys.argv[2]

    # Lakukan face recognition
    result = recognize_face(image_path, result_path)

    # Cetak hasil
    print(result)


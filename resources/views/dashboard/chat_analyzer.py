# chat_analyzer.py

from datetime import datetime

# Fungsi untuk menghitung waktu respon
def calculate_response_time(chat_logs):
    response_times = []
    for i in range(1, len(chat_logs)):
        response_time = chat_logs[i]['created_at'] - chat_logs[i - 1]['created_at']
        response_times.append(response_time.total_seconds())
    return response_times

# Fungsi untuk menghitung presentase waktu respon dalam kategori tertentu
def calculate_response_percentage(response_times, threshold):
    num_responded_within_threshold = sum(1 for time in response_times if time <= threshold)
    percentage = (num_responded_within_threshold / len(response_times)) * 100
    return percentage

def main():
    # Data contoh: Log waktu chat antara 2 user dengan kolom created_at sebagai waktu
    chat_logs = [
        {"user": "User A", "created_at": datetime(2023, 7, 17, 10, 0, 0)},
        {"user": "User B", "created_at": datetime(2023, 7, 17, 10, 2, 0)},
        {"user": "User A", "created_at": datetime(2023, 7, 17, 10, 4, 0)},
        {"user": "User B", "created_at": datetime(2023, 7, 17, 10, 5, 0)},
        {"user": "User A", "created_at": datetime(2023, 7, 17, 10, 6, 0)},
        {"user": "User B", "created_at": datetime(2023, 7, 17, 10, 8, 0)},
    ]

    response_times = calculate_response_time(chat_logs)

    # Menghitung presentase respon dalam 5 detik
    threshold = 5
    percentage_within_5_seconds = calculate_response_percentage(response_times, threshold)

    print(f"Presentase respon dalam {threshold} detik: {percentage_within_5_seconds:.2f}%")

if __name__ == "__main__":
    main()

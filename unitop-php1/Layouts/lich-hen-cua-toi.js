// user/lich-hen-cua-toi.js (PHIÊN BẢN SỬA LỖI VÀ NÂNG CẤP)

document.addEventListener('DOMContentLoaded', function() {
    // --- Lấy các thành phần HTML cần thiết ---
    const table = document.getElementById('my-appointments-table');
    const modal = document.getElementById('edit-modal');
    
    // Nếu không tìm thấy bảng, dừng lại để tránh lỗi
    if (!table) {
        console.error("Lỗi nghiêm trọng: Không tìm thấy bảng với id='my-appointments-table'.");
        return;
    }
    const closeModalButton = modal.querySelector('.close-button');
    const editForm = document.getElementById('edit-form');

    // --- Bộ lắng nghe sự kiện chính ---
    table.addEventListener('click', function(event) {
        const target = event.target.closest('button'); // Tìm nút gần nhất được click
        if (!target) return; // Nếu không click vào nút, bỏ qua

        const action = target.dataset.action;
        const row = target.closest('tr');
        const appointmentId = row.dataset.id;

        if (action === 'cancel') {
            if (confirm('Bạn có chắc chắn muốn hủy lịch hẹn này không? Hành động này không thể hoàn tác.')) {
                cancelAppointment(appointmentId, row);
            }
        } else if (action === 'edit') {
            openEditModal(appointmentId);
        }
    });

    // --- Các hàm xử lý Modal (giữ nguyên) ---
    closeModalButton.addEventListener('click', () => modal.style.display = 'none');
    window.addEventListener('click', (event) => {
        if (event.target == modal) modal.style.display = 'none';
    });
    editForm.addEventListener('submit', saveAppointmentChanges);

    // --- CÁC HÀM GỬI YÊU CẦU LÊN SERVER (NÂNG CẤP) ---

    /**
     * Hàm hủy lịch hẹn - Đã được làm cho an toàn và rõ ràng hơn
     */
    async function cancelAppointment(id, rowElement) {
        console.log(`Bắt đầu hủy lịch hẹn ID: ${id}`); // Dòng này giúp bạn debug trong F12
        try {
            const response = await fetch('user-cancel-appointment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ id: id })
            });

            // Lấy nội dung phản hồi dưới dạng text trước để kiểm tra
            const responseText = await response.text();
            console.log("Phản hồi từ server:", responseText); // Xem server trả về gì

            // Thử chuyển đổi text thành JSON
            let result;
            try {
                result = JSON.parse(responseText);
            } catch (e) {
                // Nếu server trả về lỗi HTML (ví dụ lỗi 500), nó sẽ không phải là JSON
                throw new Error("Server trả về phản hồi không hợp lệ. Hãy kiểm tra tab Network trong F12 để xem chi tiết lỗi.");
            }

            // Nếu response.ok là false (ví dụ: lỗi 403, 404, 500), ném ra lỗi với thông điệp từ server
            if (!response.ok) {
                throw new Error(result.error || 'Một lỗi không xác định đã xảy ra từ phía server.');
            }

            // Nếu mọi thứ thành công
            alert('Đã hủy lịch hẹn thành công!');
            rowElement.style.transition = 'opacity 0.5s';
            rowElement.style.opacity = '0';
            setTimeout(() => rowElement.remove(), 500); // Xóa hàng khỏi bảng sau hiệu ứng mờ dần

        } catch (error) {
            // Hiển thị thông báo lỗi rất rõ ràng cho người dùng
            console.error('Lỗi khi hủy lịch hẹn:', error);
            alert(`Không thể hủy lịch hẹn. Lý do: ${error.message}`);
        }
    }

    /**
     * Hàm mở modal chỉnh sửa (giữ nguyên logic)
     */
    async function openEditModal(id) {
        try {
            const response = await fetch(`../admin/get-appointment-details.php?id=${id}`);
            if (!response.ok) throw new Error('Không thể tải dữ liệu lịch hẹn.');
            
            const data = await response.json();
            if (data.error) throw new Error(data.error);

            document.getElementById('edit-id').value = data.id;
            document.getElementById('edit-services').value = data.services;
            const [date, time] = data.appointment_datetime.split(' ');
            document.getElementById('edit-date').value = date;
            document.getElementById('edit-time').value = time.substring(0, 5);

            modal.style.display = 'block';
        } catch (error) {
            alert(`Lỗi: ${error.message}`);
        }
    }

    /**
     * Hàm lưu thay đổi (giữ nguyên logic)
     */
    async function saveAppointmentChanges(event) {
        event.preventDefault();
        const formData = new FormData(editForm);
        const data = Object.fromEntries(formData.entries());

        try {
            const response = await fetch('user-edit-appointment.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            const result = await response.json();
            if (!response.ok || result.error) throw new Error(result.error || 'Lỗi không xác định.');

            alert('Cập nhật lịch hẹn thành công!');
            location.reload(); // Tải lại trang để thấy thay đổi
        } catch (error)
        {
            alert(`Lỗi khi lưu: ${error.message}`);
        }
    }
});
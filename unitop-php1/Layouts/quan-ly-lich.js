// admin/quan-ly-lich.js (ĐÃ ĐƠN GIẢN HÓA)
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('appointments-table');
    if (!table) return;

    table.addEventListener('click', function(event) {
        const target = event.target;
        const action = target.dataset.action;
        if (action !== 'confirm') return;

        const row = target.closest('tr');
        const appointmentId = row.dataset.id;

        if (confirm('Bạn có chắc chắn muốn XÁC NHẬN lịch hẹn này không?')) {
            updateStatus(appointmentId, 'đã xác nhận', row);
        }
    });

    async function updateStatus(id, status, rowElement) {
        try {
            const response = await fetch('update-status.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: id, status: status })
            });

            const result = await response.json();
            if (!response.ok || result.error) throw new Error(result.error || 'Lỗi không xác định.');

            alert(result.message);
            
            // Cập nhật giao diện
            rowElement.querySelector('.status').className = `status status-da-xac-nhan`;
            rowElement.querySelector('.status').textContent = 'Đã xác nhận';
            rowElement.querySelector('.actions').innerHTML = `<span>Đã xử lý</span>`;

        } catch (error) {
            alert(`Lỗi: ${error.message}`);
        }
    }
});
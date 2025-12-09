

// =============================================================================
// Price Simulator
// =============================================================================
document.addEventListener('DOMContentLoaded', function() {
    const simulator = document.querySelector('.price-simulator');
    if (!simulator) return;

    const buildingTypeInputs = document.querySelectorAll('input[name="building_type"]');
    const areaCheckboxes = document.querySelectorAll('input[name="area[]"]');
    const gradeInputs = document.querySelectorAll('input[name="grade"]');
    const priceDisplay = document.getElementById('simulator-price');
    const summaryDisplay = document.getElementById('simulator-summary');

    function calculatePrice() {
        // 建物タイプを取得
        const buildingType = document.querySelector('input[name="building_type"]:checked');
        if (!buildingType) return;
        
        const size = buildingType.value;
        const sizeLabel = buildingType.dataset.label;

        // グレードを取得
        const grade = document.querySelector('input[name="grade"]:checked');
        if (!grade) return;
        
        const gradeMultiplier = parseFloat(grade.value);
        const gradeLabel = grade.dataset.label;

        // チェックされた塗装箇所を取得
        const checkedAreas = Array.from(areaCheckboxes).filter(cb => cb.checked);
        
        if (checkedAreas.length === 0) {
            priceDisplay.textContent = '0';
            summaryDisplay.textContent = '塗装箇所を選択してください';
            return;
        }

        // 合計金額を計算
        let totalPrice = 0;
        const areaLabels = [];

        checkedAreas.forEach(checkbox => {
            const priceKey = `data-price-${size}`;
            const basePrice = parseInt(checkbox.getAttribute(priceKey)) || 0;
            totalPrice += basePrice * gradeMultiplier;
            areaLabels.push(checkbox.value);
        });

        // 金額を表示（3桁区切り）
        priceDisplay.textContent = totalPrice.toLocaleString('ja-JP');

        // サマリーを表示
        const summary = `${sizeLabel} / ${areaLabels.join('・')} / ${gradeLabel}`;
        summaryDisplay.textContent = summary;
    }

    // イベントリスナーを設定
    buildingTypeInputs.forEach(input => {
        input.addEventListener('change', calculatePrice);
    });

    areaCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', calculatePrice);
    });

    gradeInputs.forEach(input => {
        input.addEventListener('change', calculatePrice);
    });

    // 初期計算
    calculatePrice();
});

import React from 'react';

const TeklifOzet = ({ finansalOzet }) => {
  const formatter = new Intl.NumberFormat('tr-TR', {
    style: 'currency',
    currency: 'USD',
    minimumFractionDigits: 2
  });

  const formatMoney = (amount) => {
      return formatter.format(amount).replace('$', '') + ' $';
  };

  return (
    <div style={{ display: 'flex', justifyContent: 'flex-end', marginTop: '20px' }}>
      <div style={{ width: '40%' }}>
        <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '10px', fontSize: '14px', fontWeight: 'bold', color: '#666' }}>
          <span>ARA TOPLAM</span>
          <span>{formatMoney(finansalOzet.araToplam)}</span>
        </div>
        <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '10px', fontSize: '14px', fontWeight: 'bold', color: '#666' }}>
          <span>BRÜT TOPLAM</span>
          <span>{formatMoney(finansalOzet.araToplam)}</span>
        </div>
        <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '10px', fontSize: '14px', fontWeight: 'bold', color: '#666' }}>
          <span>TOPLAM K.D.V</span>
          <span>{formatMoney(finansalOzet.kdvToplam)}</span>
        </div>
        <div style={{ display: 'flex', justifyContent: 'space-between', marginTop: '15px', fontSize: '18px', fontWeight: 'bold', color: '#333' }}>
          <span>GENEL TOPLAM</span>
          <span>{formatMoney(finansalOzet.genelToplam)}</span>
        </div>
      </div>
    </div>
  );
};

export default TeklifOzet;

import React from 'react';

const TeklifKalemleriTablosu = ({ kalemler, onKalemEkle, onKalemSil, onKalemGuncelle }) => {
  
  const formatter = new Intl.NumberFormat('tr-TR', {
    style: 'currency',
    currency: 'USD',
    minimumFractionDigits: 2
  });

  return (
    <div className="items-section">
      <table style={{ width: '100%', borderCollapse: 'collapse', marginBottom: '20px' }}>
        <thead>
          <tr style={{ borderBottom: '1px solid #999', color: '#333' }}>
            <th style={{ textAlign: 'left', padding: '10px 0', fontSize: '13px', width: '45%' }}>Hizmet / Ürün</th>
            <th style={{ textAlign: 'center', padding: '10px 0', fontSize: '13px', width: '15%' }}>Miktar</th>
            <th style={{ textAlign: 'right', padding: '10px 0', fontSize: '13px', width: '15%' }}>Br. Fiyat</th>
            <th style={{ textAlign: 'right', padding: '10px 0', fontSize: '13px', width: '10%' }}>KDV</th>
            <th style={{ textAlign: 'right', padding: '10px 0', fontSize: '13px', width: '15%' }}>Toplam</th>
            <th className="no-print" style={{ width: '5%' }}></th>
          </tr>
        </thead>
        <tbody>
          {kalemler.map((kalem) => (
            <tr key={kalem.id} style={{ fontSize: '12px' }}>
              <td style={{ padding: '8px 0' }}>
                <textarea 
                  value={kalem.aciklama}
                  onChange={(e) => onKalemGuncelle(kalem.id, 'aciklama', e.target.value)}
                  style={{ width: '100%', minHeight: '34px', resize: 'vertical' }} 
                />
              </td>
              <td style={{ padding: '8px 0', textAlign: 'center' }}>
                <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', whiteSpace: 'nowrap' }}>
                    <input 
                    type="number" 
                    value={kalem.miktar}
                    onChange={(e) => onKalemGuncelle(kalem.id, 'miktar', parseFloat(e.target.value))}
                    style={{ textAlign: 'right', width: '40px', marginRight: '5px' }}
                    />
                    <span>Adet</span>
                </div>
              </td>
              <td style={{ padding: '8px 0', textAlign: 'right' }}>
                <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'flex-end', whiteSpace: 'nowrap' }}>
                    <input 
                    type="number" 
                    value={kalem.birimFiyat}
                    onChange={(e) => onKalemGuncelle(kalem.id, 'birimFiyat', parseFloat(e.target.value))}
                    style={{ textAlign: 'right', width: '60px' }}
                    />
                    <span style={{ marginLeft: '4px' }}>$</span>
                </div>
              </td>
              <td style={{ padding: '8px 0', textAlign: 'right', color: '#666' }}>
                %{kalem.kdvOran * 100}
              </td>
              <td style={{ padding: '8px 0', textAlign: 'right' }}>
                {formatter.format(kalem.miktar * kalem.birimFiyat).replace('$', '')} $
              </td>
              <td className="no-print" style={{ textAlign: 'right' }}>
                <button 
                  onClick={() => onKalemSil(kalem.id)}
                  style={{ color: 'red', border: 'none', background: 'none', cursor: 'pointer', fontSize: '16px' }}
                >
                  &times;
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
      
      <button className="primary-btn no-print" onClick={onKalemEkle} style={{ fontSize: '12px', padding: '5px 10px' }}>
        + Satır Ekle
      </button>
      
      <div style={{ borderBottom: '1px solid #ccc', margin: '20px 0' }}></div>
    </div>
  );
};

export default TeklifKalemleriTablosu;

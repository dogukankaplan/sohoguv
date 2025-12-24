import React from 'react';

const TeklifBaslik = ({ musteriBilgi, setMusteriBilgi, tarih, setTarih }) => {
  return (
    <div style={{ display: 'flex', justifyContent: 'flex-end', marginTop: '-140px', marginBottom: '60px', pointerEvents: 'auto' }}>
      <div style={{ width: '45%' }}>
        <h3 style={{ fontSize: '14px', borderBottom: '2px solid #666', paddingBottom: '5px', marginBottom: '10px', textTransform: 'uppercase' }}>MÜŞTERİ</h3>
        
        <div style={{ marginBottom: '20px' }}>
            <textarea
              placeholder="Müşteri Adı / Ünvanı Giriniz"
              value={musteriBilgi.ad}
              onChange={(e) => setMusteriBilgi({...musteriBilgi, ad: e.target.value})}
              style={{ width: '100%', fontWeight: 'bold', minHeight: '45px', resize: 'none', fontSize: '14px', textTransform: 'uppercase' }}
            />
            <textarea
              placeholder="Adres / İl / İlçe"
              value={musteriBilgi.tel} 
              onChange={(e) => setMusteriBilgi({...musteriBilgi, tel: e.target.value})}
              style={{ width: '100%', minHeight: '40px', resize: 'none', fontSize: '14px', marginTop: '5px' }}
            />
        </div>

        <div style={{ borderTop: '2px solid #ccc', marginTop: '20px' }}></div>
      </div>
    </div>
  );
};

export default TeklifBaslik;

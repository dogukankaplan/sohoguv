import React from "react";

const Header = ({ tarih, setTarih }) => {
  return (
    <header
      style={{
        display: "flex",
        justifyContent: "space-between",
        marginBottom: "40px",
      }}
    >
      <div className="company-info" style={{ display: 'flex', flexDirection: 'column', height: '100%' }}>
        {/* Logo Placeholder */}
        <div
          style={{
            display: "flex",
            alignItems: "center",
            gap: "10px",
            marginBottom: "20px",
          }}
        >
          {/* Simple Geometric Logo approximation */}
          <div style={{ width: "40px", height: "40px", position: "relative" }}>
            <div
              style={{
                position: "absolute",
                top: 0,
                left: "10px",
                width: "20px",
                height: "20px",
                background: "#00Ced1",
                borderRadius: "3px",
                transform: "rotate(45deg)",
              }}
            ></div>
            <div
              style={{
                position: "absolute",
                bottom: "5px",
                left: "0px",
                width: "20px",
                height: "20px",
                background: "#8A2BE2",
                borderRadius: "3px",
                transform: "rotate(45deg)",
              }}
            ></div>
          </div>
          <span
            style={{
              fontSize: "48px",
              fontWeight: "bold",
              letterSpacing: "-1px",
              lineHeight: 1,
            }}
          >
            soho
          </span>
        </div>

        <div style={{ fontSize: "12px", lineHeight: "1.6" }}>
          <h4 style={{ fontSize: "13px", marginBottom: "4px" }}>
            SOHO GÜVENLİK BİLGİSAYAR VE ELEKTRONİK PAZARLAMA LTD.ŞTİ.
          </h4>
          <p>İzpek iş merkezi Bornova İZMİR</p>
          <p>Operasyon Merkezi: 7014 sokak no: 25/A</p>

          <div className="mt-4">
            <p className="text-bold">İzmir / Bornova</p>
            <p>05306678335</p>
            <p>05541820731</p>
          </div>

          <div className="mt-4">
            <p className="text-bold">VD: Karşıyaka</p>
            <p>7721726850</p>
          </div>

          <div style={{ marginTop: '25px', display: 'flex', alignItems: 'center', gap: '5px' }}>
            <label style={{ fontSize: '11px', fontWeight: 'bold', color: '#666' }}>TARİH:</label>
            <input
              type="date"
              value={tarih}
              onChange={(e) => setTarih(e.target.value)}
              style={{ width: 'auto', fontSize: '11px', padding: '2px', border: '1px solid #ddd' }}
            />
          </div>
        </div>
      </div>

      <div className="document-title" style={{ marginTop: "10px" }}>
        <h1
          style={{
            fontSize: "48px",
            color: "#444",
            textTransform: "uppercase",
            letterSpacing: "1px",
          }}
        >
          TEKLİF
        </h1>
        <div
          style={{
            height: "4px",
            background: "#444",
            marginTop: "10px",
            width: "100%",
          }}
        ></div>
      </div>
    </header>
  );
};

export default Header;

import { useState, useMemo, useRef } from 'react'
import html2canvas from 'html2canvas';
import jsPDF from 'jspdf';
import Swal from 'sweetalert2';
import './TeklifPage.css'
import Header from './components/Header';
import TeklifBaslik from './components/TeklifBaslik';
import TeklifKalemleriTablosu from './components/TeklifKalemleriTablosu';
import TeklifOzet from './components/TeklifOzet';

function TeklifPage() {
  const [musteriBilgi, setMusteriBilgi] = useState({
    ad: '',
    yetkili: '',
    tel: ''
  });

  const [tarih, setTarih] = useState(new Date().toISOString().split('T')[0]);

  const [kalemler, setKalemler] = useState([
    { id: 1, aciklama: 'DAHUA IPC-HFW1230TC1-SA-0280B 2MP 2.8MM 30MT H265+ IP 67 IR BULLET IP KAMERA', miktar: 50, birimFiyat: 40.00, kdvOran: 0.20 },
    { id: 2, aciklama: 'HIKVISION DS-3E0310P-E/M 10/100 8 PORT POE 2 PORT GIGABIT UPLINK FAST ETHERNET SWITCH', miktar: 10, birimFiyat: 38.00, kdvOran: 0.20 },
    { id: 3, aciklama: 'DAHUA 305 MT PE CAT6 BAKIR', miktar: 1500, birimFiyat: 98.00, kdvOran: 0.20 },
    { id: 4, aciklama: 'SD4E225GB-HNR-A-PV1 DAHUA SPEED DOME CAMERA', miktar: 2, birimFiyat: 250.00, kdvOran: 0.20 },
  ]);

  const printRef = useRef();

  const finansalOzet = useMemo(() => {
    let araToplam = 0;
    let kdvToplam = 0;

    kalemler.forEach(kalem => {
      const satirTutari = kalem.miktar * kalem.birimFiyat;
      const kdvTutari = satirTutari * kalem.kdvOran;
      
      araToplam += satirTutari;
      kdvToplam += kdvTutari;
    });

    const genelToplam = araToplam + kdvToplam;

    return { araToplam, kdvToplam, genelToplam };
  }, [kalemler]);

  const handleKalemEkle = () => {
    const yeniId = kalemler.length > 0 ? Math.max(...kalemler.map(k => k.id)) + 1 : 1;
    setKalemler([...kalemler, { id: yeniId, aciklama: '', miktar: 1, birimFiyat: 0, kdvOran: 0.20 }]);
  };

  const handleKalemSil = (id) => {
    setKalemler(kalemler.filter(kalem => kalem.id !== id));
  };

  const handleKalemGuncelle = (id, alan, deger) => {
    setKalemler(kalemler.map(kalem => 
      kalem.id === id ? { ...kalem, [alan]: deger } : kalem
    ));
  };

  const handleDownloadPDF = async () => {
    const element = printRef.current;
    
    // Helper to resolve colors to RGB using Canvas
    const ctx = document.createElement('canvas').getContext('2d');
    const resolveToRgb = (colorStr) => {
        if (!colorStr || !colorStr.includes('oklch')) return colorStr;
        ctx.fillStyle = colorStr;
        return ctx.fillStyle; 
    };

    // Helper: Recursively copy computed styles
    const copyComputedStyles = (source, target) => {
        const computed = window.getComputedStyle(source);
        const properties = [
            'display', 'width', 'height', 'margin', 'padding', 'border', 
            'backgroundColor', 'color', 'fontSize', 'fontWeight', 'fontFamily', 
            'textAlign', 'lineHeight', 'boxShadow', 'borderRadius', 'position', 
            'top', 'left', 'right', 'bottom', 'flexDirection', 'alignItems', 'justifyContent', 'gap',
            'whiteSpace', 'boxSizing', 'zIndex', 'overflow', 'textTransform', 'letterSpacing'
        ];
        
        // Manual copy for properties
        let cssText = '';
        properties.forEach(prop => {
            let val = computed[prop];
            // Fix: resolve oklch for specified properties
            if (['color', 'backgroundColor', 'borderColor'].includes(prop) || prop.startsWith('border')) {
                 if (val && val.includes('oklch')) val = resolveToRgb(val);
            }
            if (val) cssText += `${prop.replace(/[A-Z]/g, m => `-${m.toLowerCase()}`)}: ${val}; `;
        });
        
        target.style.cssText += cssText;

        // Recursively handle children
        for (let i = 0; i < source.children.length; i++) {
            if (target.children[i]) {
                copyComputedStyles(source.children[i], target.children[i]);
            }
        }
    };

    // 1. Prepare clone
    const clone = element.cloneNode(true);
    
    // 2. Fix Inputs in Clone
    const originalInputs = element.querySelectorAll('input, textarea, select');
    const cloneInputs = clone.querySelectorAll('input, textarea, select');
    originalInputs.forEach((original, index) => {
        const cloned = cloneInputs[index];
        if (!cloned) return;
        const value = original.value;
        const parent = cloned.parentNode;
        const textSpan = document.createElement('span');
        textSpan.textContent = value;
        const inputStyle = window.getComputedStyle(original);
        textSpan.style.fontFamily = inputStyle.fontFamily;
        textSpan.style.fontSize = inputStyle.fontSize;
        textSpan.style.fontWeight = inputStyle.fontWeight;
        textSpan.style.color = resolveToRgb(inputStyle.color);
        textSpan.style.textAlign = inputStyle.textAlign; 
        
        // Fix for clipping issues (both top and bottom)
        textSpan.style.padding = '4px 4px'; // Increased padding
        textSpan.style.lineHeight = '1.4'; // Increased line-height
        textSpan.style.display = 'inline-block';
        textSpan.style.verticalAlign = 'middle';
        textSpan.style.minHeight = '1.4em';
        
        // CRITICAL: Override fixed heights from inputs to prevent bottom clipping
        textSpan.style.height = 'auto';
        textSpan.style.maxHeight = 'none';
        textSpan.style.overflow = 'visible';
        
        textSpan.style.whiteSpace = 'pre-wrap';
        parent.replaceChild(textSpan, cloned);
    });
    
    // 3. IFRAME ISOLATION STRATEGY
    const iframe = document.createElement('iframe');
    iframe.style.position = 'fixed';
    iframe.style.top = '-9999px';
    iframe.style.width = '1200px'; // Desktop width to prevent wrapping
    iframe.style.height = '2000px'; 
    iframe.style.border = 'none';
    document.body.appendChild(iframe);
    
    const iframeDoc = iframe.contentWindow.document;
    iframeDoc.open();
    // Inject Fonts and basic centering styles
    iframeDoc.write(`
      <html>
        <head>
          <title>Print</title>
          <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
          <style>
            body {
              margin: 0;
              padding: 0;
              background: white;
              display: flex;
              justify-content: center; /* Center horizontally */
              align-items: flex-start;
              width: 100%;
            }
            .printing-clone {
               margin: 0 auto; /* Explicitly center the page wrapper */
               background: white;
               /* Force explicit A4 dimensions if needed, but cloned styles should handle it */
            }
          </style>
        </head>
        <body></body>
      </html>
    `);
    iframeDoc.close();

    // 4. BAKE STYLES & APPEND
    // Synchronized traversal to copy computed styles
    const bakeStyles = (originalNode, cloneNode) => {
        if (originalNode.nodeType !== 1) return;
        
        const computed = window.getComputedStyle(originalNode);
        
        // Extended list of properties to ensure fidelity
        const properties = [
            'display', 'position', 'top', 'right', 'bottom', 'left', 'float', 'clear',
            'width', 'height', 'min-width', 'min-height', 'max-width', 'max-height',
            'margin-top', 'margin-right', 'margin-bottom', 'margin-left',
            'padding-top', 'padding-right', 'padding-bottom', 'padding-left',
            'border-top-width', 'border-right-width', 'border-bottom-width', 'border-left-width',
            'border-top-style', 'border-right-style', 'border-bottom-style', 'border-left-style',
            'border-top-color', 'border-right-color', 'border-bottom-color', 'border-left-color',
            'border-radius', 'box-shadow', 'background-color', 'background-image', 
            'color', 'font-family', 'font-size', 'font-weight', 'line-height', 'text-align', 
            'text-transform', 'letter-spacing', 'white-space', 'overflow', 'opacity', 'z-index',
            'box-sizing', 'flex', 'flex-basis', 'flex-direction', 'flex-grow', 'flex-shrink', 
            'flex-wrap', 'justify-content', 'align-items', 'align-content', 'gap'
        ];

        properties.forEach(prop => {
             let val = computed.getPropertyValue(prop);
             if (val && val.includes('oklch')) {
                 cloneNode.style.setProperty(prop, resolveToRgb(val));
             } else if (val) {
                 cloneNode.style.setProperty(prop, val);
             }
        });

        // Hide buttons
        if (cloneNode.tagName === 'BUTTON' || cloneNode.classList.contains('no-print')) {
            cloneNode.style.display = 'none';
        }

        let childOriginal = originalNode.firstElementChild;
        let childClone = cloneNode.firstElementChild;
        
        while (childOriginal && childClone) {
            bakeStyles(childOriginal, childClone);
            childOriginal = childOriginal.nextElementSibling;
            childClone = childClone.nextElementSibling;
        }
    };

    try {
        bakeStyles(element, clone);
    } catch (err) {
        console.warn("Style baking warning:", err);
    }

    // Append populated clone to iframe
    iframeDoc.body.appendChild(clone);
    
    try {
        await document.fonts.ready;
        // Small delay to ensure iframe renders fonts
        await new Promise(resolve => setTimeout(resolve, 500));

        const canvas = await html2canvas(clone, {
            scale: 2,
            useCORS: true,
            logging: false,
            // Important: Render the CLONE directly, which is now in the iframe context
            // But we must pass the element correctly. 
            // html2canvas(clone) works if clone is in document.
            windowWidth: 1200,
            allowTaint: true,
            backgroundColor: '#ffffff'
        });

        const imgData = canvas.toDataURL('image/png');
        const pdf = new jsPDF('p', 'mm', 'a4');
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = (canvas.height * pdfWidth) / canvas.width;
        
        pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
        pdf.save(`teklif_${musteriBilgi.ad || 'taslak'}.pdf`);
        
        Swal.fire({
            title: 'Başarılı!',
            text: 'PDF başarıyla oluşturuldu.',
            icon: 'success',
            confirmButtonText: 'Tamam',
            confirmButtonColor: '#00ced1'
        });
    } catch (error) {
        console.error("PDF generation failed:", error);
        Swal.fire({
            title: 'Hata!',
            text: 'PDF oluşturulamadı: ' + error.message,
            icon: 'error',
            confirmButtonText: 'Tamam'
        });
    } finally {
        document.body.removeChild(iframe);
    }
  };

  return (
    <div className="teklif-app-container">
      <div className="teklif-toolbar">
        <h3>Teklif Hazırlama</h3>
        <button onClick={handleDownloadPDF} className="teklif-primary-btn">PDF Olarak İndir</button>
      </div>

      <div className="teklif-paper-wrapper" ref={printRef}>
        <Header tarih={tarih} setTarih={setTarih} />
        
        <TeklifBaslik 
          musteriBilgi={musteriBilgi} 
          setMusteriBilgi={setMusteriBilgi}
        />
        
        <TeklifKalemleriTablosu
          kalemler={kalemler}
          onKalemEkle={handleKalemEkle}
          onKalemSil={handleKalemSil}
          onKalemGuncelle={handleKalemGuncelle}
        />

        <TeklifOzet finansalOzet={finansalOzet} />

        <div className="teklif-footer-note" style={{ marginTop: 'auto', paddingTop: '40px', fontSize: '11px', color: '#666', borderTop: '1px solid #eee' }}>
            <div style={{ display: 'flex', justifyContent: 'space-between' }}>
               <span>Bu belge dijital olarak oluşturulmuştur.</span>
               <span>SAYFA 1 / 1</span>
            </div>
        </div>
      </div>
    </div>
  )
}

export default TeklifPage

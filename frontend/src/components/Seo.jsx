import { Helmet } from 'react-helmet-async';

const Seo = ({ title, description, keywords }) => {
  return (
    <Helmet>
      <title>{title || 'SOHO Güvenlik Sistemleri | İzmir'}</title>
      <meta name="description" content={description || 'İzmir güvenlik sistemleri, kamera sistemleri ve alarm çözümleri'} />
      {keywords && <meta name="keywords" content={keywords} />}
    </Helmet>
  );
};

export default Seo;

import {Container, Navbar} from 'react-bootstrap';
import styles from './Footer.module.css';

const Footer = () => {
  return (
    <>
      <Navbar className={styles.navBar} variant="dark">
        <Container>
          <div className="d-flex w-100 justify-content-center">Seattle Consulting Myanmar</div>
        </Container>
      </Navbar>
    </>
  )
}

export default Footer;
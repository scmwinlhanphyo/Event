import {Container, Nav, Navbar} from 'react-bootstrap';
import { Link } from 'react-router-dom';
import styles from './Header.module.scss';

const Header = () => {
  return (
    <>
      <Navbar className={styles.navBar} variant="dark">
        <Container>
          <Navbar.Brand as={Link} to="/admin/events">Event</Navbar.Brand>
          <Nav className="me-auto">
            <Nav.Link as={Link} to="/admin/events">Event</Nav.Link>
            <Nav.Link as={Link} to="/admin/users">User</Nav.Link>
          </Nav>
        </Container>
      </Navbar>
    </>
  )
}

export default Header;
import React from 'react';
import { useHistory } from 'react-router-dom';
import {Button, Form, Container } from 'react-bootstrap';
import { useDispatch } from "react-redux";
import { LOGIN_SUCCESS } from "../../store/actions/types";
import styles from './LoginPage.module.css';

const LoginPage = () => {
  const [formData, setFormData] = React.useState({
    email: '',
    password: ''
  });
  const [disabledLoginBtn, setDisabledLoginBtn] = React.useState(true);
  const [validated, setValidated] = React.useState(false);
  const history = useHistory();
  const dispatch = useDispatch();

  /**
   * handle textbox change register button disabled enabled.
   */
  const handleChange = (event) => {
    const name = event.target.name;
    const value = event.target.value;
    let preFormData = formData;
    preFormData[name] = value;
    setFormData({...preFormData});
    
    if (preFormData.email && preFormData.password) {
      setDisabledLoginBtn(false);
    } else {
      setDisabledLoginBtn(true);
    }
    setValidated(true);
  };

  const handleSubmit = () => {
    if (formData.email === 'admin@gmail.com' && formData.password === 'password') {
      const token = 12345;

      /** store logged in user's info to local storage */
      localStorage.setItem(
        "user",
        JSON.stringify({
          accessToken: token,
          ...formData
        })
      );

      /** store logged in user's info to App State */
      dispatch({
        type: LOGIN_SUCCESS,
        payload: {
          user: {
            accessToken: '12345',
            ...formData
          },
        }
      });
      history.push('/admin/events');
    } else {
      alert('username or password is wrong');
    }

    // axios.post("auth/login", formData)
    // .then((res) => {
    //   const { data } = res;
    //   const { token } = data.success;
    //   const { user } = data;

    //   /** store logged in user's info to local storage */
    //   localStorage.setItem(
    //     "user",
    //     JSON.stringify({
    //       accessToken: token,
    //       ...user
    //     })
    //   );

    //   /** store logged in user's info to App State */
    //   dispatch({
    //     type: LOGIN_SUCCESS,
    //     payload: {
    //       user: {
    //         accessToken: token,
    //         ...user
    //       },
    //     }
    //   });
    // })
    // .then(() => navigate('/home'))
    // .catch((error) => {
    //   if (error.response) {
    //     console.error(error.response.data);
    //     // if (error.response.data.errors) {
    //     //   this.setState({
    //     //     errors: error.response.data.errors
    //     //   });
    //     // }
    //   }
    // });
  }

  return (
    <Container className={styles.container}>
      <Form validated={validated} noValidate onSubmit={handleSubmit}>
        <Form.Group className="mb-3" controlId="formBasicEmail">
          <Form.Label>Email address</Form.Label>
          <Form.Control
            required
            name="email"
            type="email"
            placeholder="Enter email"
            value={formData.email}
            onChange={handleChange}
          />
          <Form.Control.Feedback type="invalid">
            Email is invalid
          </Form.Control.Feedback>
        </Form.Group>

        <Form.Group className="mb-3" controlId="formBasicPassword">
          <Form.Label>Password</Form.Label>
          <Form.Control
            required
            name="password"
            type="password"
            placeholder="Password"
            value={formData.password}
            onChange={handleChange}
          />
          <Form.Control.Feedback type="invalid">
            Password is invalid
          </Form.Control.Feedback>
        </Form.Group>
        <Form.Group className="mb-3" controlId="formBasicCheckbox">
          <Form.Check type="checkbox" label="Check me out" />
        </Form.Group>
        <Button variant="primary" disabled={disabledLoginBtn} type="submit">
          Submit
        </Button>
      </Form>
    </Container>
  )
}

export default LoginPage;

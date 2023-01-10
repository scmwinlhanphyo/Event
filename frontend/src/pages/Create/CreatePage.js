import React, { Fragment, useRef, useState } from "react";
import { Breadcrumb, Button, Container, Form, InputGroup, Row, Col, Image } from "react-bootstrap";
import { useHistory, useLocation } from 'react-router-dom';
import styles from './CreatePage.module.scss';
import moment from 'moment';

const CreatePage = () => {
  const history = useHistory();
  const location = useLocation().pathname;
  const [createForm, setCreateForm] = useState(false);
  const [updateForm, setUpdateForm] = useState(false);
  const [touched, setTouched] = useState(false);
  const mounted = useRef(false);

  const [formData, setFormData] = React.useState({
    'name': '',
    'email': '',
    'password': '',
    'confirmPassword': '',
    'phone': ''
  });

  React.useEffect(() => {
    if (!mounted.current) {
      checkURL();
    }
    mounted.current = true;

    function checkURL() {
      if (location === '/admin/user/create') {
        setCreateForm(true);
      }
      else {
        setUpdateForm(true);
        setDisabledSubmitBtn(false);
        setValidated(true);

        setFormData({
          'name': 'userA',
          'email': 'usera@gmail.com',
          'address': 'ygn',
          'role': 'admin',
          'dob': '15-11-1998',
          'password': 'usera@123',
          'confirmPassword': 'usera@123',
          'profile': '',
          'phone': '09450000888'
        });
      }
    }
  }, []);

  const [errors, setErrors] = React.useState({
    name: '',
    email: '',
    role: '',
    password: '',
    confirmPassword: '',
    phone: ''
  })
  const [disabledSubmitBtn, setDisabledSubmitBtn] = React.useState(true);
  const [validated, setValidated] = React.useState(false);
  const [preview, setPreview] = React.useState({});

  const handleChange = (event) => {
    const name = event.target.name;
    const value = event.target.value;
    let preFormData = formData;
    preFormData[name] = value;
    setFormData({ ...preFormData });

    if (preFormData.name && preFormData.email && preFormData.password && preFormData.confirmPassword && preFormData.phone) {
      setDisabledSubmitBtn(false);
    } else {
      setDisabledSubmitBtn(true);
    }

    if(name == 'profile') {
      const file = event.target.files[0];
      handlePreview(file);
    }

    let valid = validateInput(preFormData);
    if (valid) {
      setValidated(true);
    } else {
      setValidated(false);
    }
  };

  const handlePreview = (file) => {
    const objURL = URL.createObjectURL(file);
    setPreview(objURL);
  }

  const validateInput = (preFormData) => {
    if (preFormData.password.length > 0 && preFormData.password.length < 8) {
      errors.password = "Passwords should be at least 8 characters.";
    } else {
      errors.password = '';
    }

    if (preFormData.password !== preFormData.confirmPassword) {
      errors.confirmPassword = "Passwords don't match! Please try again.";
    } else {
      errors.confirmPassword = '';
    }

    let digitPattern = new RegExp("^[0-9]{0,11}$");
    if (!digitPattern.test(preFormData.phone)) {
      errors.phone = "Invalid phone number format! Please try again.";
    } else if (preFormData.phone && digitPattern.test(preFormData.phone) && preFormData.phone.length > 0 && preFormData.phone.length < 11)
      errors.phone = "Phone number should be at least 11 characters! Please try again.";
    else {
      errors.phone = '';
    }
    if (errors.password || errors.confirmPassword || errors.phone) {
      return false;
    } else {
      return true;
    }
  }

  const handleSubmit = (event) => {
    event.preventDefault();
    if (validated) {
      history.push('/admin/users');
    }
  };

  const handleBlur = (event) => {
    const name = event.target.name;
    const value = event.target.value;
    let preFormError = errors;
    if(!value) {
      preFormError.name = name+' is required.';
    }
    else {
      preFormError.name = '';
    }
    setErrors({...preFormError});
  }

  const handleClear = () => {
    setFormData({
      'name': '',
      'email': '',
      'password': '',
      'confirmPassword': '',
      'phone': ''
    });
  }

  return (
    <div className={styles.wrapper}>
      <Breadcrumb className={styles.breadcrumb}>
        <Breadcrumb.Item href='/admin/users'>Users</Breadcrumb.Item>
        {createForm && <Breadcrumb.Item href='#' active className={styles.active}>Create User</Breadcrumb.Item>}
        {updateForm && <Breadcrumb.Item href='#' active className={styles.active}>Update User</Breadcrumb.Item>}
      </Breadcrumb>
      <Container className={styles.container}>
        {createForm && <h1 className={styles.registerTtl}> User Create Form </h1>}
        {updateForm && <h1 className={styles.registerTtl}> User Update Form </h1>}
        <Form onSubmit={handleSubmit}>
          <Form.Group className="mb-3">
            <Form.Control
              required
              name="name"
              type="text"
              placeholder="Name"
              value={formData.name}
              onChange={handleChange}
              className={styles.formControl}
              isValid={!errors.name}
              isInvalid={errors.name}
              onBlur={handleBlur}
            />
            <span className="invalid-feedback">
              {errors.name}
            </span>
          </Form.Group>
          <InputGroup className="mb-3 align-items-center justify-content-between">
            <InputGroup.Text>User Role</InputGroup.Text>
            <Form.Check 
              required
              name="role"
              type="radio"
              label="Admin"
              onChange={handleChange}
            />
            <Form.Check 
              required
              name="role"
              type="radio"
              label="User"
              onChange={handleChange}
            />
          </InputGroup>
          <Form.Group className="mb-3">
            <Form.Control
              required
              name="email"
              type="email"
              placeholder="Email"
              value={formData.email}
              onChange={handleChange}
              className={styles.formControl}
              onBlur={handleBlur}
            />
            <span className="invalid-feedback">
              {errors.email}
            </span>
          </Form.Group>
          <Form.Group className="mb-3">
            <Form.Control
              name="address"
              as="textarea"
              placeholder="Address"
              value={formData.address}
              onChange={handleChange}
              className={styles.formControl}
            />
          </Form.Group>
          <InputGroup className="mb-3">
            <InputGroup.Text>Date of Birth</InputGroup.Text>
            <Form.Control
              name="dob"
              type="date"
              value={formData.dob}
              onChange={handleChange}
              className={styles.formControl}
            />
          </InputGroup>
          <Form.Group as={Row} className="mb-3 align-items-center">
            <Form.Label column sm={4} className={styles.formLabel}>Profile Picture</Form.Label>
            <div className="mb-3">
              <Image src={preview} name="profile" className={styles.profileImg}></Image>
            </div>
            <Col>
              <Form.Control
                type="file"
                name="profile"
                value={formData.profile}
                onChange={handleChange}
              />
            </Col>
          </Form.Group>
          <Form.Group className="mb-3">
            <Form.Control
              required
              name="password"
              type="password"
              placeholder="Password"
              value={formData.password}
              onChange={handleChange}
              className={styles.formControl}
              isInvalid={errors.password}
            />
            <Form.Control.Feedback type="invalid">
              {errors.password}
            </Form.Control.Feedback>
          </Form.Group>
          <Form.Group className="mb-3">
            <Form.Control
              required
              name="confirmPassword"
              type="password"
              placeholder="Confirm Password"
              value={formData.confirmPassword}
              onChange={handleChange}
              className={styles.formControl}
              isInvalid={errors.confirmPassword}
            />
            <Form.Control.Feedback type="invalid">
              {errors.confirmPassword}
            </Form.Control.Feedback>
          </Form.Group>
          <Form.Group className="mb-3">
            <Form.Control
              required
              name="phone"
              type="tel"
              placeholder="Phone Number"
              value={formData.phone}
              onChange={handleChange}
              className={styles.formControl}
              isInvalid={errors.phone}
            />
            <Form.Control.Feedback type="invalid">
              {errors.phone}
            </Form.Control.Feedback>
          </Form.Group>
          <div className="d-flex mt-5 justify-content-around">
            <Button type="reset" className={styles.resetBtn} onClick={handleClear}>
              Clear
            </Button>
            {createForm &&
              <Button type="submit" className={styles.registerBtn} disabled={disabledSubmitBtn}>
                Create
              </Button>
            }
            {updateForm &&
              <Button type="submit" className={styles.registerBtn} disabled={disabledSubmitBtn}>
                Update
              </Button>
            }
          </div>
        </Form>
      </Container>
    </div>
  );
}

export default CreatePage;

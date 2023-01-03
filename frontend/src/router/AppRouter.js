import React from "react";
import { Switch, Redirect, withRouter } from "react-router-dom";
import PublicRoute from "./PublicRoute";
import PrivateRoute from "./PrivateRoute";
import LoginPage from "../pages/Login/LoginPage";
import HomePage from "../pages/Home/HomePage";
import AboutPage from "../pages/About/AboutPage";
import Header from "../components/Header";

const AppRouter = withRouter(({ location }) => {

  /**
   * make path for each component.
   */
  return (
    <>
      {
        location.pathname !== '/login' && <Header showMenu={true} />
      }
    <Switch>
      <PublicRoute path="/login" component={LoginPage} />
      <PrivateRoute path="/home" component={HomePage} />
      <PrivateRoute path="/about" component={AboutPage} />

      {/* Redirect all 404's to home */}
      <Redirect to='/home' />
    </Switch>
    </>
  )
})

export default AppRouter;
